import Vue from 'vue'
import Router from 'vue-router'
import { loadMessages } from '~/plugins/i18n'
import { scrollBehavior, getLocalizationPrefix as prefix } from '~/utils'

Vue.use(Router)

const page = path => () => import(`~/pages/${path}`).then(m => m.default || m)

const routes = [
  {
    path: '/',
    redirect: '/ru',
  },
  {
    path: '/:lang?',
    component: {
      render (c) { return c('router-view') }
    },
    children: [
      { 
        path: '',
        name: 'welcome', 
        component: page('guest/welcome.vue'),
      },
      { 
        path: 'oils',
        name: 'oils', 
        component: page('guest/oils.vue'),
      },
      { 
        path: 'oils/:name',
        name: 'oil', 
        component: page('guest/oil.vue'),
      },
      { 
        path: 'login', 
        name: 'login', 
        component: page('auth/login.vue'),
      },
      { 
        path: 'register', 
        name: 'register', 
        component: page('auth/register.vue'),
      },
      { 
        path: 'password/reset', 
        name: 'password.request', 
        component: page('auth/password/email.vue'),
      },
      { 
        path: 'password/reset/:token', 
        name: 'password.reset', 
        component: page('auth/password/reset.vue'),
      },
      { 
        path: 'email/verify/:id', 
        name: 'verification.verify', 
        component: page('auth/verification/verify.vue'),
      },
      { 
        path: 'email/resend', 
        name: 'verification.resend', 
        component: page('auth/verification/resend.vue'),
      },
      { 
        path: 'home', 
        name: 'home', 
        component: page('home.vue'),
      },
      {
        path: 'settings',
        component: page('settings/index.vue'),
        children: [
          { 
            path: '', 
            redirect: { name: 'settings.profile' },
          },
          { 
            path: 'profile', 
            name: 'settings.profile', 
            component: page('settings/profile.vue'),
          },
          { 
            path: 'password', 
            name: 'settings.password', 
            component: page('settings/password.vue'),
          },
        ],
      },
    ]
  }
]

export function createRouter () {
  return new Router({
    routes,
    scrollBehavior,
    mode: 'history'
  })
}
