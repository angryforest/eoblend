import axios from 'axios'
import Vue from 'vue'

export const state = () => ({
	oil: {},
    oils: [],
    types: [],
    properties: [],
    checkedOils: [],
	checkedProperties: [],
})

export const getters = {
    oil: state => state.oil,
    oils: state => state.oils,
    types: state => state.types,
    properties: state => state.properties,
    checkedOils: state => state.checkedOils,
    checkedProperties: state => state.checkedProperties,
}

export const mutations = {
	setOils (state, { oils, types, properties }) {
		state.oils = oils
		state.types = types
		state.properties = properties
	},

	setOil (state, oil) {
		state.oil = oil
	},

	toggleProperty (state, id) {
        if (state.checkedProperties.includes(id))
          state.checkedProperties.splice(
          	state.checkedProperties.indexOf(id), 1)
        else state.checkedProperties.push(id)
	},

	toggleOil (state, id) {
        if (state.checkedOils.includes(id))
        	state.checkedOils.splice(
        		state.checkedOils.indexOf(id), 1)
        else state.checkedOils.push(id)
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