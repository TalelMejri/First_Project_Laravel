import Vue from 'vue'
import VueRouter from 'vue-router'
import HomeView from '../views/HomeView.vue'
import ajouteruser from '../views/ajouteruser.vue'
import edituser from '../views/edituser.vue'
Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/ajouteruser',
    name: 'ajouteruser',
    component: ajouteruser
  },
  {
    path: '/edituser/:id',
    name: 'edituser',
    component: edituser
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
