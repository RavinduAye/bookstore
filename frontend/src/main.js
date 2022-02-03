import Vue from 'vue';
import App from './App.vue';
import VueRouter from 'vue-router';
import vueResource from 'vue-resource';
import JwPagination from 'jw-vue-pagination';
Vue.component('jw-pagination',JwPagination);

import Navbar from './components/NavBar.vue';
import Home from './components/Home.vue';
import UserProfile from './components/UserProfile.vue';


Vue.component('navbar',Navbar);

Vue.use(VueRouter);
Vue.use(vueResource);


const routes = [
  {
    path: '/',component: Home
  },
  {
    path: '/userprofile',component: UserProfile
  }
];

const router = new VueRouter({
  routes,
  mode : 'history'
})

new Vue({
  el: '#app',
  router,
  render: h => h(App)
})
