require('./bootstrap');
window.Vue = require('vue');

import router from "./router";

import VueMaterial from 'vue-material'
import 'vue-material/dist/vue-material.min.css'
Vue.use(VueMaterial)

import Vue from 'vue';
import VueHtml2Canvas from 'vue-html2canvas';
Vue.use(VueHtml2Canvas);

Vue.component('loader', require('./components/loader.vue').default);
Vue.component('header-vue', require('./components/header/header.vue').default);
Vue.component('line-charts', require('./components/charts/line/line.vue').default);
Vue.component('doughnut-charts', require('./components/charts/doughnut/doughnut.vue').default);
Vue.component('pie-charts', require('./components/charts/pie/pie.vue').default);
Vue.component('horizontalBar-charts', require('./components/charts/horizontalBar/horizontalBar.vue').default);
Vue.component('bar-charts', require('./components/charts/bar/bar.vue').default);

const app = new Vue({
    el: '#app',
    router,
    icons: {
        iconfont: 'mdi', // default - only for display purposes
    }
});

