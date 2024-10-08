// Admin routes

import type { RouteRecordRaw } from "vue-router";

export const adminRoutes: RouteRecordRaw[] = [
    {
        path: '/admin',
        redirect: '/admin/dashboard'
    },
    {
        path: '/admin/dashboard',
        name: 'admin-dashboard',
        component: () => import('../views/admin/DashboardView.vue'),
        meta: {
            auth: true,
            role: 'admin'
        }
    },
    {
        path: '/admin/laporan',
        name: 'admin-laporan',
        component: () => import('../views/admin/ReportView.vue'),
        meta: {
            auth: true,
            role: 'admin'
        }
    },
    {
        path: '/admin/category',
        name: 'admin-category',
        component: () => import('../views/admin/CategoryListView.vue'),
        meta: {
            auth: true,
            role: 'admin'
        }
    },
    {
        path: '/admin/supplier',
        name: 'admin-supplier',
        component: () => import('../views/admin/SupplierListView.vue'),
        meta: {
            auth: true,
            role: 'admin'
        }
    },
    {
        path: '/admin/items',
        name: 'admin-item-list',
        component: () => import('../views/admin/ItemListView.vue'),
        meta: {
            auth: true,
            role: 'admin'
        }
    },
    {
        path: '/admin/barang-masuk',
        name: 'admin-incoming-item',
        component: () => import('../views/admin/IncomingItemListView.vue'),
        meta: {
            auth: true,
            role: 'admin'
        }
    },
    {
        path: '/admin/barang-masuk/:id',
        name: 'admin-item-in-detail',
        component: () => import('../views/admin/IncomingItemDetailView.vue'),
        meta: {
            auth: true,
            role: 'admin'
        }
    },
    {
        path: '/admin/barang-keluar',
        name: 'admin-item-out',
        component: () => import('../views/admin/OutgoingItemListView.vue'),
        meta: {
            auth: true,
            role: 'admin'
        }
    },
    {
        path: '/admin/barang-keluar/:id',
        name: 'admin-item-out-detail',
        component: () => import('../views/admin/OutgoingItemDetailView.vue'),
        meta: {
            auth: true,
            role: 'admin'
        }
    },
    {
        path: '/admin/pengadaan',
        name: 'admin-pengadaan-list',
        component: () => import('../views/admin/SubmissionListView.vue'),
        meta: {
            auth: true,
            role: 'admin'
        }
    },
    {
        path: '/admin/pengadaan/tambah',
        name: 'admin-pengadaan-add',
        component: () => import('../views/admin/SubmissionAddView.vue'),
        meta: {
            auth: true,
            role: 'admin'
        }
    },
    {
        path: '/admin/pengadaan/:id',
        name: 'admin-pengadaan-detail',
        component: () => import('../views/admin/SubmissionDetailView.vue'),
        meta: {
            auth: true,
            role: 'admin'
        }
    },
    {
        path: '/admin/permintaan',
        name: 'admin-permintaan-list',
        component: () => import('../views/admin/RequestListView.vue'),
        meta: {
            auth: true,
            role: 'admin'
        }
    },
    {
        path: '/admin/permintaan/:id',
        name: 'admin-permintaan-detail',
        component: () => import('../views/admin/RequestDetailView.vue'),
        meta: {
            auth: true,
            role: 'admin'
        }
    },
    {
        path: '/admin/users',
        name: 'admin-user-list',
        component: () => import('../views/admin/UserListView.vue'),
        meta: {
            auth: true,
            role: 'admin'
        }
    }
]