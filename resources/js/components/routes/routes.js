import Vue from './node_modules/vue'
import VueRouter from './node_modules/vue-router'
Vue.use(VueRouter)

// Defining all components for routings
import AppHome from '../AppHome';

// 2. Define some routes
// Each route should map to a component. The "component" can
// either be an actual component constructor created via
// `Vue.extend()`, or just a component options object.
// We'll talk about nested routes later.

const routes = [
  
  //{ path: '/login', component: AppLogin },
  
]

// 3. Create the router instance and pass the `routes` option
// You can pass in additional options here, but let's
// keep it simple for now.
const router = new VueRouter({
  routes, // short for `routes: routes`
  mode: 'history',
  hashbang: false,
})
router.mode = 'html5'

export default router;