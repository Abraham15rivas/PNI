require('./bootstrap');

window.Vue = require('vue');
import VueMaterial from 'vue-material'
import 'vue-material/dist/vue-material.min.css'

Vue.use(VueMaterial)
import VueRouter from 'vue-router'

Vue.use(VueRouter)

Vue.component('loader', require('./components/loader.vue').default);

Vue.component('header-vue', require('./components/header/header.vue').default);
Vue.component('line-charts', require('./components/charts/line/line.vue').default);
Vue.component('doughnut-charts', require('./components/charts/doughnut/doughnut.vue').default);
Vue.component('pie-charts', require('./components/charts/pie/pie.vue').default);
Vue.component('horizontalBar-charts', require('./components/charts/horizontalBar/horizontalBar.vue').default);
Vue.component('bar-charts', require('./components/charts/bar/bar.vue').default);

import homeComponent from './pages/home/homeComponent';
import researcherComponent from './pages/researcher/researcherComponent';
import researchComponent from './pages/research/researchComponent';
import profileResearchComponent from './pages/profileResearch/profileResearchComponent';
import currentResearchComponent from './pages/currentResearch/currentResearchComponent';
import reportComponent from './pages/reports/reportsComponent';

const router = new VueRouter({
    routes: [
        {
            path: '/',
            component: homeComponent
        },
        {
            path: '/home',
            component: homeComponent
        },
        {
            path: '/investigadores',
            component: researcherComponent
        },
        {
            path: '/research',
            component: researchComponent
        },
        {
            path: '/profileResearch',
            component: profileResearchComponent
        },
        {
            path: '/currentResearch',
            component: currentResearchComponent
        },
        {
            path: '/reports',
            component: reportComponent
        }
    ],
    mode: 'history'
})

const app = new Vue({
    el: '#app',
    router,
    icons: {
        iconfont: 'mdi', // default - only for display purposes
    }
});

