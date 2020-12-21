import axios from 'axios'

export const state = () => ({
	oil: {},
    oils: [],
    properties: [],
    oilProperties: {},
    compatibility: {},
})

export const getters = {
    oil: state => state.oil,
    oils: state => state.oils,
    properties: state => state.properties,
    oilProperties: state => state.oilProperties,
    compatibility: state => state.compatibility,
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
			const { data } = await axios.get('oil/' + name)
			commit('setOil', data)
	    } 
	    catch (e) {
	      	console.error(e);
	    }
	},
}