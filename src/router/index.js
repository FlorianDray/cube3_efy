import { createRouter, createWebHistory } from 'vue-router'

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
      component: () => import('../views/UserConnectView.vue'),
      path: '/sneaker',
      name: 'sneaker',
      component: () => import('../views/OneSneakerView.vue')
    },
    {
      path: '/sneaker/:id',
      name: 'sneaker',
      component: () => import('../views/OneSneakerView.vue')
    },
    {
      path: '/allSneakers',
      name: 'allSneakers',
      component: () => import('../views/allSneakersView.vue')
    }
  ]
})

export default router
