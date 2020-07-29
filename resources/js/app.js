// require('./bootstrap');
import 'es6-promise/auto'
import axios from 'axios'
import Vue from 'vue'
import VueAuth from '@websanova/vue-auth'
import VueAxios from 'vue-axios'
import VueRouter from 'vue-router'
import Index from './Index'
import auth from './auth'
import router from './router'
// Set Vue globally


import Vuetify from 'vuetify';

window.Vue = Vue
// Set Vue router
Vue.router = router
Vue.use(VueRouter)
// Set Vue authentication
Vue.use(VueAxios, axios)
axios.defaults.baseURL = '/api/v1'
Vue.use(VueAuth, auth)
Vue.use(Vuetify);
// auth.priv = function (role) {
//   return auth.check(role, 'privileges');
// }
import "vuetify/dist/vuetify.min.css";

// Load Index
Vue.component('index', Index)
const app = new Vue({
  el: '#app',
  vuetify: new Vuetify(),
  router: router
});