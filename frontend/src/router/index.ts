import { useUserStore } from '@/stores/user'
import { createRouter, createWebHistory } from 'vue-router'
import { adminRoutes } from './admin'
import { divisionRoutes } from './division'

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

// Login middleware
router.beforeEach(async (to, _, next) => {
  const user = useUserStore()
  await user.load()

  const isLogin = await user.checkLogin();

  if (to.meta.auth && !isLogin) {
    return next({ path: '/auth/login' })
  }

  // if already logged in, redirect to dashboard/home
  if (to.name === 'login' && isLogin) {
    switch (user.data.role) {
      case 'admin':
          return next({ path: '/admin/dashboard' })
      case 'unit':
          return next({ path: '/user/home' })
      case 'pengawas':
          return next({ path: '/admin/dashboard' })
      }
  }

  if (to.meta.role && to.meta.role !== user.data.role) {
    return next({ name: 'forbidden' })
  }

  return next()
})

router.onError((err) => {
  console.log(err)
})

export default router
