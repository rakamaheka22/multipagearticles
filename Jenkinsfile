pipeline{
    agent any
    options{
        timestamps()
        skipDefaultCheckout true
        disableConcurrentBuilds()
        buildDiscarder logRotator(artifactDaysToKeepStr: '', artifactNumToKeepStr: '40', daysToKeepStr: '', numToKeepStr: '40')
    }
    triggers{
        bitbucketPush overrideUrl: ''
        bitBucketTrigger([
            [
                $class: 'BitBucketPPRPullRequestTriggerFilter',
                actionFilter: [
                    $class: 'BitBucketPPRPullRequestCreatedActionFilter'
                ]
            ],
            [
                $class: 'BitBucketPPRRepositoryTriggerFilter',
                actionFilter: [
                    $class: 'BitBucketPPRRepositoryPushActionFilter',
                    allowedBranches: '',
                    triggerAlsoIfTagPush: true
                ]
            ]
        ])
    }
    environment{
        PROJECT = "multipagearticles"
        REGISTRY = "104943189603.dkr.ecr.ap-southeast-1.amazonaws.com/${PROJECT}"
        REGISTRY_CREDENTIAL = "ecr:ap-southeast-1:payrollbird-registry-credential"
        BOT_TOKEN = credentials('telegram-token')
        CHAT_ID = credentials('multipagearticles-chat-id')
        BRANCH = "${env.BRANCH_NAME}".replace("/","-")
        TAG_BUILD = "${BRANCH}-${env.BUILD_NUMBER}"
        PORT = "8900"
    }
    stages{
        stage("Checkout"){
            steps{
                checkout scm
                sh label: 'Create Build Folder', script: 'rm -rf build/logs && mkdir -p build/logs'
            }
        }
        stage("Testing Code"){
            parallel{
                stage("Check Code"){
                    steps{
                        sh label: 'Checking Code', script: 'find . -type f -name \'*.php\' ! \\( -path \'./vendor/*\' \\) -print0 | xargs -0 -n1 php74 -l'
                    }
                    post {
                        always {
                            recordIssues qualityGates: [[threshold: 1, type: 'NEW_ERROR', unstable: false]], tools: [php()]
                        }
                    }
                }
                stage("Checkstyle"){
                    steps{
                        sh label: 'Checkstyle Command', script: "phpcs --report=checkstyle --report-file=./build/logs/checkstyle.xml --standard=PSR2 --extensions=php --ignore=*/vendor/*,*/database/*,*/bootstrap/* . || exit 0"
                    }
                    post{
                        always{
                            recordIssues(tools: [phpCodeSniffer(pattern: 'build/logs/checkstyle.xml')])
                        }
                    }
                }
                stage("Copy Paste Detection"){
                    steps{
                        sh label: 'CPD Command', script: "phpcpd --log-pmd build/logs/pmd-cpd.xml --exclude vendor . || exit 0"
                    }
                    post{
                        always{
                            recordIssues(tools: [cpd(pattern: 'build/logs/pmd-cpd.xml')])
                        }
                    }
                }
            }
        }
        stage("Code Quality"){
            environment{
                SCANNER_HOME = tool 'sonarqube-scanner'
            }
            steps{
                script{
                    if (env.BRANCH_NAME == 'master' || env.BRANCH_NAME == 'develop') {
                        withSonarQubeEnv("Sonarqube Server"){
                            sh "${SCANNER_HOME}/bin/sonar-scanner \
                            -Dsonar.projectName=${PROJECT}-${env.BRANCH_NAME} \
                            -Dsonar.projectKey=${PROJECT}:${env.BRANCH_NAME} \
                            -Dsonar.projectVersion=${env.BUILD_NUMBER} \
                            -Dsonar.exclusions=database/**,public/vendor/**,docker/** \
                            -Dsonar.sources=."
                        }
                    }
                    else {
                        echo "Skip code quality"
                    }
                }
            }
        }
        stage("Quality Gateway") {
            steps {
                script {
                    if (env.BRANCH_NAME == 'master' || env.BRANCH_NAME == 'develop') {
                        timeout(time: 1, unit: 'HOURS') {
                    waitForQualityGate abortPipeline: false
                }
                    }
                    else {
                        echo "Skip quality gateway"
                    }
                }
            }
        }
        stage("Build"){
            steps{
                script {
                    ENV_CONFIG = (env.BRANCH_NAME == "master") ? "env-uat" : "env-dev"

                    withCredentials([file(credentialsId: "${ENV_CONFIG}", variable: 'ENV_FILE')]) {
                        sh label: 'Copy ENV file', script: "cp \${ENV_FILE} ./"
                        sh label: 'Fix permission', script: "chmod 644 .env"
                    }

                    dockerImage = docker.build("${REGISTRY}:${TAG_BUILD}", ".")
                }
            }
        }
        stage("Integration"){
            steps{
                script{
                    sh label: 'Add Registry to ENV File', script: 'echo "" >> .env && echo "REGISTRY_IMAGE=${REGISTRY}" >> .env'
                    sh label: 'Add Docker Tag to ENV File', script: 'echo "TAG=${TAG_BUILD}" >> .env'
                    sh label: 'Add Port to ENV File', script: 'echo "PORT_HOST=${PORT}" >> .env'

                    sh """
                        echo 'Waiting until port ${PORT} not used by other process ...'

                        while nc -z localhost ${PORT}; do
                            sleep 1
                        done
                    """

                    sh label: 'Run Docker Compose', script: "docker-compose up -d"
                    sleep 25

                    // Test integration
                    httpRequest consoleLogResponseBody: true, httpMode: 'GET', url: "http://localhost:${PORT}/"
                }
            }
            post{
                always{
                    sh label: 'Remove container', script: "docker-compose down -v"
                }
            }
        }
        stage("Deploy Development"){
            when{
                branch 'develop'
            }
            steps{
                script {
                    TAG_DEV = "dev-latest"

                    docker.withRegistry("https://" + REGISTRY, REGISTRY_CREDENTIAL) {

                        dockerImage.push("${TAG_BUILD}")
                        dockerImage.push("${TAG_DEV}")
                    }

                    withCredentials([file(credentialsId: 'jenkins-ssh', variable: 'JENKINS_IDENTITY')]) {
                        remote = [:]
                        remote.name = 'multipagearticles-dev'
                        remote.host = '172.31.28.11'
                        remote.user = 'deploy'
                        remote.identityFile = "${JENKINS_IDENTITY}"
                        remote.allowAnyHosts = true

                        sshCommand remote: remote, command: "eval \$(aws ecr get-login --no-include-email --region ap-southeast-1)"
                        sshCommand remote: remote, command: "docker stack deploy --with-registry-auth -c /home/deploy/multipagearticles/docker-compose.yml multipagearticles"
                        sshCommand remote: remote, command: "docker rmi -f \$(docker images -f 'dangling=true' -q) || :"
                    }
                }
            }
            post{
                always{
                    sh label: 'Remove dev tag image', script: "docker rmi -f ${REGISTRY}:${TAG_DEV} || :"
                }
                success{
                    telegramNotification("Development")
                }
            }
        }
    }
    post{
        always{
            sh label: 'Remove build image', script: "docker rmi -f ${REGISTRY}:${TAG_BUILD} || :"
        }
        failure{
            sh label: 'Telegram notification', script: "telegram -t ${BOT_TOKEN} -c ${CHAT_ID} -M 'Oops.. Something wrong happened when build ${PROJECT}. Please check [here](${env.BUILD_URL})'"
        }
    }
}

def telegramNotification(String server) {
    // Git Env
    COMMIT_HASH = sh (script: 'git --no-pager show -s --format=\'%H\'', returnStdout: true).trim()
    COMMIT_HASH_SHORT = sh (script: 'git --no-pager show -s --format=\'%h\'', returnStdout: true).trim()
    COMMITER_NAME = sh (script: 'git --no-pager show -s --format=\'%an\'', returnStdout: true).trim()
    COMMIT_MESSAGE = sh (script: 'git --no-pager show -s --format=\'%B\' -n 1', returnStdout: true).trim()
    COMMIT_MESSAGE = "${COMMIT_MESSAGE}".replace("_","-").replace("'","")
    COMMIT_LINK = "https://bitbucket.org/rollingglory/multipagearticles/commits/${COMMIT_HASH}"

    MESSAGE = "Changes are deployed to ***${PROJECT} $server*** server by ***${COMMITER_NAME}***.\n[${COMMIT_HASH_SHORT}](${COMMIT_LINK}) : ${COMMIT_MESSAGE}."

    sh label: 'Telegram Notification',  script: "telegram -t ${BOT_TOKEN} -c ${CHAT_ID} -M '${MESSAGE}'"
}
