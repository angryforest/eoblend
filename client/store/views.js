import axios from 'axios'
import Vue from 'vue'

export const state = () => ({
    views: [],
})

export const getters = {
    views: state => state.views,
}

export const mutations = {
	setViews (state, { pageViews }) {
		state.views = pageViews
	},
}

export const actions = {
	async fetchViews ({ commit }) {
		commit('setLoading', true, { root: true })

	    try {
			const { data } = await axios.get('page-views')
			commit('setViews', data)
	    } 
	    catch (e) {
	      	console.error(e);
	    }
	    finally {
	      	commit('setLoading', false, { root: true })
	    }
	},

	async fetchViewsByUrl ({ commit }, url) {
		commit('setLoading', true, { root: true })
		
	    try {
			const { data } = await axios.get('page-views/url', { params: { url } })
			commit('setViews', data)
	    } 
	    catch (e) {
	      	console.error(e);
	    }
	    finally {
	      	commit('setLoading', false, { root: true })
	    }
	},
}