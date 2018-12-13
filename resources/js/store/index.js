import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

export const store = new Vuex.Store({
  state: {
		accessToken: localStorage.getItem("accessToken") || null,
		user: JSON.parse(localStorage.getItem("user")) || {}
	},
	mutations: {},
	actions: {},
	getters: {}
});