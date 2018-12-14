import Vue from "vue";
import Vuex from "vuex";
Vue.use(Vuex);

export const store = new Vuex.Store({
	state: {
		// accessToken: localStorage.getItem("accessToken") || null,
		// user: JSON.parse(localStorage.getItem("user")) || {}
		accessToken: null,
		user: {}
	},
	mutations: {
		createSession(state){
			state.accessToken = localStorage.getItem("accessToken");
			state.user = JSON.parse(localStorage.getItem("user"));
		},
		destroySession(state){
			state.accessToken = null;
			state.user = {};
		},
	},
	actions: {},
	getters: {}
});
