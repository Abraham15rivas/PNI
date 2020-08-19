require('./bootstrap');

window.Vue = require('vue');

// import Vuetify from 'vuetify'
import '@mdi/font/css/materialdesignicons.css'
import VueRouter from 'vue-router'

// Vue.use(Vuetify);
Vue.use(VueRouter)

Vue.component('header-vue', require('./components/header/header.vue').default);

import homeComponent from './pages/home/homeComponent';
import researcherComponent from './pages/researcher/researcherComponent';
import researchComponent from './pages/research/researchComponent';

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
        }
    ]
})


const app = new Vue({
    el: '#app',
    router,
    icons: {
        iconfont: 'mdi', // default - only for display purposes
    },
});
