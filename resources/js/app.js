// require('./bootstrap');
/* 
import './bootstrap';
import Vue from 'vue';
import Vuetify from 'vuetify';

Vue.use(Vuetify);
import Routes from './routes.js';
import App from './components/App';

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    router: Routes,
    // components: {
    //     App
    // },
    // router: Routes, 
    render: h => h(App)
});

export default app;
 */

require('./bootstrap');
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
window.Vue = Vue
// Set Vue router
Vue.router = router
Vue.use(VueRouter)
// Set Vue authentication
Vue.use(VueAxios, axios)
axios.defaults.baseURL = '/api/v1'
Vue.use(VueAuth, auth)
// Load Index
Vue.component('index', Index)
const app = new Vue({
  el: '#app',
  router
});