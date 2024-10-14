
// Division

import type { RouteRecordRaw } from "vue-router";

export const divisionRoutes: RouteRecordRaw[] = [
    {
        path: '/user',
        redirect: '/user/home'
    },
    {
        path: '/user/home',
        name: 'user-home',
        component: () => import('../views/user/HomeView.vue'),
        meta: {
            auth: true,
            role: 'unit'
        }
    },
    {

        
        path: '/user/permintaan',
        name: 'user-permintaan',
        component: () => import('../views/user/RequestView.vue'),
        meta: {
            auth: true,
            role: 'unit'
        }
    },
    {
        path: '/user/permintaan/:id',
        name: 'user-permintaan-detail',
        component: () => import('../views/user/RequestDetailView.vue'),
        meta: {
            auth: true,
            role: 'unit'
        }
    },
    {
        path: '/user/pengadaan',
        name: 'user-pengadaan',
        component: () => import('../views/user/SubmissionView.vue'),
        meta: {
            auth: true,
            role: 'unit'
        },
    },
    {
        path: '/user/pengadaan/tambah',
        name: 'user-pengadaan-add',
        component: () => import('../views/user/SubmissionAddView.vue'),
        meta: {
            auth: true,
            role: 'unit'
        },
    },
    {
        path: '/user/pengadaan/:id',
        name: 'user-pengadaan-detail',
        component: () => import('../views/user/SubmissionDetailView.vue'),
        meta: {
            auth: true,
            role: 'unit'
        }
    },
]