import Cookies from 'js-cookie'
import { cookieFromRequest, getPrefixFromRequest } from '~/utils'

export const state = () => ({
    loading: false,
})

export const getters = {
    loading: state => state.loading,
}

export const mutations = {
  setLoading (state, loading) {
    state.loading = loading
  },
}

export const actions = {
  nuxtServerInit ({ commit }, { req }) {
    const token = cookieFromRequest(req, 'token')
    if (token) commit('auth/SET_TOKEN', token)

    const locale = getPrefixFromRequest(req)
    commit('lang/SET_LOCALE', { locale })
  },

  nuxtClientInit ({ commit, getters }) {
    const token = Cookies.get('token')
    if (token && !getters['auth/token']) 
      commit('auth/SET_TOKEN', token)
  }
}
