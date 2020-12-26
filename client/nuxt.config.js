require('dotenv').config()
const { join } = require('path')
const { copySync, removeSync } = require('fs-extra')

process.env.NODE_TLS_REJECT_UNAUTHORIZED = '0';

module.exports = {
  ssr: true,

  srcDir: __dirname,

  env: {
    ga: process.env.GA_ID,
    ym: process.env.YM_ID,
    nodeEnv: process.env.NODE_ENV,
    year: new Date().getFullYear(),
    apiUrl: process.env.API_URL,
    appUrl: process.env.APP_URL,
    appName: process.env.APP_NAME,
    nodeEnv: process.env.NODE_ENV,
    appLocale: process.env.APP_LOCALE,
    githubAuth: !!process.env.GITHUB_CLIENT_ID,
    fallbackLocale: process.env.APP_FALLBACK_LOCALE,
  },

  head: {
    htmlAttrs: {
      lang: process.env.APP_LOCALE,
    },
    title: process.env.APP_NAME,
    titleTemplate: '%s | ' + process.env.APP_NAME,
    meta: [
      { 
        charset: 'utf-8' 
      },
      { 
        name: 'viewport', 
        content: 'width=device-width, initial-scale=1' 
      },
      { 
        hid: 'description', 
        name: 'description', 
        content: '' 
      },
    ],
    link: [
      { 
        rel: 'icon', 
        type: 'image/x-icon', 
        href: '/img/favicon.ico',
      },
    ],
  },

  loading: { 
    color: '#007bff',
  },

  router: {
    middleware: [
      'locale', 
      'check-auth'
    ],
  },

  css: [
    { 
      src: '~assets/sass/app.scss', 
      lang: 'scss' 
    },
  ],

  plugins: [
    '~components/global',
    '~plugins/i18n',
    '~plugins/vform',
    '~plugins/axios',
    '~plugins/fontawesome',
    '~plugins/nuxt-client-init',
    '~plugins/router-locale-sync',
    { src: '~plugins/bootstrap', mode: 'client' },
  ],

  modules: [
    '@nuxtjs/router',
  ],

  build: {
    extractCSS: true,
    babel: {
      plugins: [
        '@babel/plugin-proposal-optional-chaining',
        '@babel/plugin-proposal-nullish-coalescing-operator',
      ]
    },
  },

  hooks: {
    generate: {
      done (generator) {
        // Copy dist files to public/_nuxt
        if (generator.nuxt.options.dev === false && generator.nuxt.options.mode === 'spa') {
          const publicDir = join(generator.nuxt.options.rootDir, 'public', '_nuxt')
          removeSync(publicDir)
          copySync(join(generator.nuxt.options.generate.dir, '_nuxt'), publicDir)
          copySync(join(generator.nuxt.options.generate.dir, '200.html'), join(publicDir, 'index.html'))
          removeSync(generator.nuxt.options.generate.dir)
        }
      },
    },
  },

}
