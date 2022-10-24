import Vue from 'vue'
import VueRouter from 'vue-router'
import HomeView from '../views/HomeView.vue'
import ajouteruser from '../views/ajouteruser.vue'
import edituser from '../views/edituser.vue'
import usersCards from '../views/usersCards.vue';
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
  },
  {
    path: '/users',
    name: 'users',
    component: usersCards,
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
