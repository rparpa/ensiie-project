import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import myMap from "../components/myMap";

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/map',
    name: 'Map',
    component: myMap
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
