
import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import homeComponent from '../pages/home/homeComponent';
import researcherComponent from '../pages/researcher/researcherComponent';
import researchComponent from '../pages/research/researchComponent';
import profileResearchComponent from '../pages/profileResearch/profileResearchComponent';
import currentResearchComponent from '../pages/currentResearch/currentResearchComponent';

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
        }
    ],
    mode: 'history'
})

export default router