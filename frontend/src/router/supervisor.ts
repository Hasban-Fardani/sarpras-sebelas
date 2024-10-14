
// Supervisor routes

import type { RouteRecordRaw } from "vue-router";

export const supervisorRoutes: RouteRecordRaw[] = [
    {
        path: '/supervisor',
        redirect: '/supervisor'
    },
    {
        path: '/supervisor/dashboard',
        name: 'supervisor-dashoard',
        component: () => import('../views/supervisor/DashboardView.vue'),
        meta: {
            auth: true,
            role: 'pengawas'
        }
    },
]