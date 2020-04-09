// require('./bootstrap');
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
