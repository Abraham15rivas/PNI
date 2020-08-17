require('./bootstrap');

window.Vue = require('vue');

// import Vuetify from 'vuetify'
import '@mdi/font/css/materialdesignicons.css'
// Vue.use(Vuetify);

Vue.component('auth', require('./components/auth/AuthComponent.vue').default);
Vue.component('header-vue', require('./components/header.vue').default);


const app = new Vue({
    el: '#app',
    // vuetify: new Vuetify(),
    icons: {
        iconfont: 'mdi', // default - only for display purposes
    },
});

