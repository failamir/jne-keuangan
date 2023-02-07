import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const View = { template: '<router-view></router-view>' }

const routes = [
  {
    path: '/',
    component: () => import('@pages/Layout/DashboardLayout.vue'),
    redirect: 'dashboard',
    children: [
      {
        path: 'dashboard',
        name: 'dashboard',
        component: () => import('@pages/Dashboard.vue'),
        meta: { title: 'global.dashboard' }
      },
      {
        path: 'user-management',
        name: 'user_management',
        component: View,
        redirect: { name: 'permissions.index' },
        children: [
          {
            path: 'permissions',
            name: 'permissions.index',
            component: () => import('@cruds/Permissions/Index.vue'),
            meta: { title: 'cruds.permission.title' }
          },
          {
            path: 'permissions/create',
            name: 'permissions.create',
            component: () => import('@cruds/Permissions/Create.vue'),
            meta: { title: 'cruds.permission.title' }
          },
          {
            path: 'permissions/:id',
            name: 'permissions.show',
            component: () => import('@cruds/Permissions/Show.vue'),
            meta: { title: 'cruds.permission.title' }
          },
          {
            path: 'permissions/:id/edit',
            name: 'permissions.edit',
            component: () => import('@cruds/Permissions/Edit.vue'),
            meta: { title: 'cruds.permission.title' }
          },
          {
            path: 'roles',
            name: 'roles.index',
            component: () => import('@cruds/Roles/Index.vue'),
            meta: { title: 'cruds.role.title' }
          },
          {
            path: 'roles/create',
            name: 'roles.create',
            component: () => import('@cruds/Roles/Create.vue'),
            meta: { title: 'cruds.role.title' }
          },
          {
            path: 'roles/:id',
            name: 'roles.show',
            component: () => import('@cruds/Roles/Show.vue'),
            meta: { title: 'cruds.role.title' }
          },
          {
            path: 'roles/:id/edit',
            name: 'roles.edit',
            component: () => import('@cruds/Roles/Edit.vue'),
            meta: { title: 'cruds.role.title' }
          },
          {
            path: 'users',
            name: 'users.index',
            component: () => import('@cruds/Users/Index.vue'),
            meta: { title: 'cruds.user.title' }
          },
          {
            path: 'users/create',
            name: 'users.create',
            component: () => import('@cruds/Users/Create.vue'),
            meta: { title: 'cruds.user.title' }
          },
          {
            path: 'users/:id',
            name: 'users.show',
            component: () => import('@cruds/Users/Show.vue'),
            meta: { title: 'cruds.user.title' }
          },
          {
            path: 'users/:id/edit',
            name: 'users.edit',
            component: () => import('@cruds/Users/Edit.vue'),
            meta: { title: 'cruds.user.title' }
          }
        ]
      },
      {
        path: 'poutings',
        name: 'poutings.index',
        component: () => import('@cruds/Poutings/Index.vue'),
        meta: { title: 'cruds.pouting.title' }
      },
      {
        path: 'poutings/create',
        name: 'poutings.create',
        component: () => import('@cruds/Poutings/Create.vue'),
        meta: { title: 'cruds.pouting.title' }
      },
      {
        path: 'poutings/:id',
        name: 'poutings.show',
        component: () => import('@cruds/Poutings/Show.vue'),
        meta: { title: 'cruds.pouting.title' }
      },
      {
        path: 'poutings/:id/edit',
        name: 'poutings.edit',
        component: () => import('@cruds/Poutings/Edit.vue'),
        meta: { title: 'cruds.pouting.title' }
      },
      {
        path: 'setorans',
        name: 'setorans.index',
        component: () => import('@cruds/Setorans/Index.vue'),
        meta: { title: 'cruds.setoran.title' }
      },
      {
        path: 'setorans/create',
        name: 'setorans.create',
        component: () => import('@cruds/Setorans/Create.vue'),
        meta: { title: 'cruds.setoran.title' }
      },
      {
        path: 'setorans/:id',
        name: 'setorans.show',
        component: () => import('@cruds/Setorans/Show.vue'),
        meta: { title: 'cruds.setoran.title' }
      },
      {
        path: 'setorans/:id/edit',
        name: 'setorans.edit',
        component: () => import('@cruds/Setorans/Edit.vue'),
        meta: { title: 'cruds.setoran.title' }
      },
      {
        path: 'cashflows',
        name: 'cashflows.index',
        component: () => import('@cruds/Cashflows/Index.vue'),
        meta: { title: 'cruds.cashflow.title' }
      },
      {
        path: 'cashflows/create',
        name: 'cashflows.create',
        component: () => import('@cruds/Cashflows/Create.vue'),
        meta: { title: 'cruds.cashflow.title' }
      },
      {
        path: 'cashflows/:id',
        name: 'cashflows.show',
        component: () => import('@cruds/Cashflows/Show.vue'),
        meta: { title: 'cruds.cashflow.title' }
      },
      {
        path: 'cashflows/:id/edit',
        name: 'cashflows.edit',
        component: () => import('@cruds/Cashflows/Edit.vue'),
        meta: { title: 'cruds.cashflow.title' }
      }
    ]
  }
]

export default new VueRouter({
  mode: 'history',
  base: '/admin',
  routes
})
