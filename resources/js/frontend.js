require('./bootstrap');

window.Vue = require('vue');

Vue.use(require('vue-resource'));

Vue.component('infinite-scroll-article-content', require('./components/InfiniteScrollArticleContent.vue').default);

Vue.component('InfiniteLoading', require('vue-infinite-loading'));

const app = new Vue({
    el: '#app',
});
