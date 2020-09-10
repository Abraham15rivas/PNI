require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router'

Vue.use(VueRouter)

Vue.component('header-vue', require('./components/header/header.vue').default);
Vue.component('line-charts', require('./components/line/line.vue').default);
Vue.component('doughnut-charts', require('./components/doughnut/doughnut.vue').default);
Vue.component('pie-charts', require('./components/pie/pie.vue').default);
Vue.component('horizontalBar-charts', require('./components/horizontalBar/horizontalBar.vue').default);
Vue.component('bar-charts', require('./components/bar/bar.vue').default);

import homeComponent from './pages/home/homeComponent';
import researcherComponent from './pages/researcher/researcherComponent';
import researchComponent from './pages/research/researchComponent';
import profileResearchComponent from './pages/profileResearch/profileResearchComponent';
import currentResearchComponent from './pages/currentResearch/currentResearchComponent';

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
            path: '/researcher',
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
        }
    ],
    mode: 'history'
})


const app = new Vue({
    el: '#app',
    router,
    icons: {
        iconfont: 'mdi', // default - only for display purposes
    },
});

