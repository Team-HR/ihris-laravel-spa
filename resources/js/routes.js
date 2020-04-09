import Vue from 'vue';
import VueRouter from 'vue-router';

// Register the Components
import Cores from './components/Cores';
import ExampleComponent from './components/ExampleComponent';
import HomeComponent from './components/HomeComponent';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        { path:'/cores', component: Cores },
        { path:'/home', component: HomeComponent }
    ]
});

export default router;
