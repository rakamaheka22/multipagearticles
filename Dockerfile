# Build Stage 1
#
FROM composer:1.10.7 AS PHPVENDOR
WORKDIR /src/

COPY composer.json composer.json
COPY composer.lock composer.lock
COPY database/ database/
RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

# Build Stage 2
#
FROM node:10-alpine AS FRONTEND
WORKDIR /src/

COPY package*.json ./
RUN npm install
COPY public/ /src/public
COPY resources/ /src/resources
COPY webpack.mix.js webpack.mix.js
COPY webpack-admin.mix.js webpack-admin.mix.js
COPY .env /src/.env
RUN npm run production
RUN npm run prod:admin

# Build Stage 3
#
FROM 104943189603.dkr.ecr.ap-southeast-1.amazonaws.com/php:7.4-fpm-nginx
LABEL author="Rolling Glory <hello@rollingglory.com>" \
    name="Multipage Articles Web" \
    version="1.0"

WORKDIR /var/www/html

COPY --chown=nginx:nginx . /var/www/html/
COPY --chown=nginx:nginx --from=PHPVENDOR /src/vendor /var/www/html/vendor
COPY --chown=nginx:nginx --from=FRONTEND /src/public /var/www/html/public

COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/default.conf /etc/nginx/conf.d/default.conf
COPY docker/www.conf /usr/local/etc/php-fpm.d/www.conf
COPY docker/php.ini /usr/local/etc/php/php.ini
COPY docker/supervisord.conf /etc/supervisord.conf

RUN chmod -R 775 storage/ && chmod -R 775 bootstrap/ && rm -rf ./docker

EXPOSE 8080
