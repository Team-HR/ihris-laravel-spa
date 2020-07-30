import VueRouter from 'vue-router'

// Pages
import Home from './pages/Home'
import Register from './auth/Register'
import Login from './auth/Login'
import Dashboard from './pages/Dashboard'
// Cores Components 
import Cores from './pages/Cores'
// System Admin Components
import AccountsManagement from './pages/AccountsManagement'

// Routes
const routes = [
  {
    path: '/',
    name: 'home',
    component: Home,
    meta: {
      auth: true
    }
  },
  {
    path: '/register',
    name: 'register',
    component: Register,
    meta: {
      auth: false
    }
  },
  {
    path: '/login',
    name: 'login',
    component: Login,
    meta: {
      auth: false
    }
  },
  // USER ROUTES
  {
    path: '/dashboard',
    name: 'dashboard',
    component: Dashboard,
    meta: {
      auth: true
    }
  },
  // CORES ROUTES
  {
    path: '/cores',
    name: 'cores',
    component: Cores,
    meta: {
      auth: {
        // check roles if
        roles: ['sysadmin','admin'],
        // if not then 
        redirect: '/sysadmin/login',
        // if logged in but not found
        notFoundRedirect: {name: 'error-404'},
        // if logged in but forbidden access
        forbiddenRedirect: '/403'
      }
    }
  },
  // SYS ADMIN ROUTES
  {
    path: '/sysadmin/accounts/management',
    name: 'AccountsManagement',
    component: AccountsManagement,
    meta: {
      auth: {
        // check roles if
        roles: ['sysadmin','admin'],
        // if not then 
        redirect: '/sysadmin/login',
        // if logged in but not found
        notFoundRedirect: {name: 'error-404'},
        // if logged in but forbidden access
        forbiddenRedirect: '/403'
      }
    }
  },
]
const router = new VueRouter({
  history: true,
  mode: 'history',
  routes,
})
export default router