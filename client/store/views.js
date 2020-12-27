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
	    try {
			const { data } = await axios.get('page-views')
			commit('setViews', data)
	    } 
	    catch (e) {
	      	console.error(e);
	    }
	},
}