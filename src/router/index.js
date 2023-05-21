import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: () => import('../views/HomeView.vue')
    },
    {
      path: '/userForm',
      name: 'userform',
      component: () => import('../views/UserFormview.vue')
    },
    {
      path: '/userConnect',
      name: 'userConnect',
      component: () => import('../views/UserConnectView.vue')
    }
  ]
})

export default router
