import { loadMessages } from '~/plugins/i18n'

export default ({ app: { router, store } }) => {
  router.afterEach((to, next) => {
    const locale = to.params.lang
    store.commit('lang/SET_LOCALE', { locale })
    loadMessages(locale)
  })
}