import axios from 'axios'
import Vue from 'vue'

export const state = () => ({
	oil: {},
    oils: [],
    types: {},
    oilTypes: {},
    properties: {},
    checkedOils: {},
    oilProperties: {},
    compatibility: {},
	checkedProperties: {},
})

export const getters = {
    oil: state => state.oil,
    oils: state => state.oils,
    types: state => state.types,
    oilTypes: state => state.oilTypes,
    properties: state => state.properties,
    checkedOils: state => state.checkedOils,
    oilProperties: state => state.oilProperties,
    compatibility: state => state.compatibility,
    checkedProperties: state => state.checkedProperties,
}

export const mutations = {
	setOils (state, { oils, types, properties, oilTypes, oilProperties, compatibility }) {
		state.oils = oils
		state.types = types
		state.oilTypes = oilTypes
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