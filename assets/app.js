import './styles/app.css';
import './bootstrap';

import * as Vue from "vue"
import App from './js/App.vue';

import * as VueRouter from 'vue-router'

//screens
import Home from "./js/screens/Home.vue";
import Inbox from "./js/screens/Inbox.vue";
import Companies from "./js/screens/Companies.vue";
import FindJob from "./js/screens/FindJob.vue";
import FindMission from "./js/screens/FindMission.vue";
import FindEvent from "./js/screens/FindEvent.vue";
import Publications from "./js/screens/Publications.vue";


const router = VueRouter.createRouter({
    history: VueRouter.createWebHistory(),
    routes: [
        { path: '/', component: Home },
        { path: '/inbox', component: Inbox },
        { path: '/companies', component: Companies },
        { path: '/findjob', component: FindJob },
        { path: '/findmission', component: FindMission },
        { path: '/findevent', component: FindEvent },
        { path: '/publications', component: Publications },
    ]
  });


Vue.createApp(App).use(router).mount('#app');