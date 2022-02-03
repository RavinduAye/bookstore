import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Home from './components/Home.vue';
import UserProfile from './components/UserProfile.vue';


const router = new VueRouter({
    
    mode : 'history',
    
    routes : [ 
    {
        path: '/',component: Home
    },
    {
        path: '/userprofile',component: UserProfile
    }]
  });
  