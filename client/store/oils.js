import axios from 'axios'
import Vue from 'vue'

export const state = () => ({
	oil: {},
    oils: [],
    properties: [],
    oilProperties: {},
    compatibility: {},
    checkedOils: {},
	checkedProperties: {},
})

export const getters = {
    oil: state => state.oil,
    oils: state => state.oils,
    properties: state => state.properties,
    checkedOils: state => state.checkedOils,
    oilProperties: state => state.oilProperties,
    compatibility: state => state.compatibility,
    checkedProperties: state => state.checkedProperties,
}

export const mutations = {
	setOils (state, { oils, properties, oilProperties, compatibility }) {
		state.oils = oils
		state.properties = properties
		state.oilProperties = oilProperties
		state.compatibility = compatibility
	},

	setOil (state, oil) {
		state.oil = oil
	},

	toggleProperty (state, id) {
        if (state.checkedProperties[id])
          Vue.delete(state.checkedProperties, id)
        else Vue.set(state.checkedProperties, id, true)
	},

	toggleOil (state, id) {
        if (state.checkedOils[id])
          Vue.delete(state.checkedOils, id)
        else Vue.set(state.checkedOils, id, true)
	},
}

export const actions = {
	async fetchOils ({ commit }) {
	    try {
			const { data } = await axios.get('oils')
			commit('setOils', data)
	    } 
	    catch (e) {
	      	console.error(e);
	    }
	},

	async fetchOil ({ commit }, name) {
	    try {
			const { data } = await axios.get('oils/' + name)
			commit('setOil', data)
	    } 
	    catch (e) {
	      	console.error(e);
	    }
	},
}