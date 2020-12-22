//import Cookies from 'js-cookie'

export const state = () => ({
  locale: 'ru',
  default: 'ru',
  locales: {
    'ru': 'Русский',
    'en': 'English',
    'es': 'Español',
    'zh': '中文',
  }
})

export const getters = {
  locale: state => state.locale,
  locales: state => state.locales
}

export const mutations = {
  SET_LOCALE (state, { locale }) {
    state.locale = state.locales[locale] ? locale : state.default
  },
}

export const actions = {
  setLocale ({ commit }, { locale }) {
    commit('SET_LOCALE', { locale })
  },
}
