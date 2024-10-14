import { createRouter, createWebHistory } from 'vue-router'
import { adminRoutes } from './admin'
import { divisionRoutes } from './division'
import { defineMiddleware } from './middleware'
import { supervisorRoutes } from './supervisor'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      redirect: '/auth/login'
    },

    // === Auth ===
    {
      path: '/auth/login',
      name: 'login',
      component: () => import('../views/auth/LoginView.vue'),
      meta: {
        auth: false
      }
    },
    {
      path: '/auth/reset-password',
      name: 'reset-password',
      component: () => import('../views/auth/ResetPasswordView.vue')
    },

    // === account profile ===
    {
      path: '/profile',
      name: 'profile',
      component: () => import('../views/ProfileView.vue'),
      meta: {
        auth: true
      }
    },

    ...adminRoutes,
    ...divisionRoutes,
    ...supervisorRoutes,

    // === Exceptions ===
    {
      path: '/:pathMatch(.*)*',
      name: 'not-found',
      component: () => import('../views/error/NotFoundView.vue'),
      meta: {
        auth: true
      }
    },
    {
      path: '/forbidden',
      name: 'forbidden',
      component: () => import('../views/error/ForbiddenView.vue')
    }
  ]
})

defineMiddleware(router)

router.onError((err) => {
  console.log(err)
})

export default router
