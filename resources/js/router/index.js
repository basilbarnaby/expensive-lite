import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

export const router = new VueRouter({
	mode: "history",
	routes: [
		{
			path: "/",  
			component: require("../components/Home.vue"), 
			name: "home"
    },
		{
			path: "/login",  
			component: require("../components/auth/Login.vue"), 
			name: "login"
    },
    
	]
});