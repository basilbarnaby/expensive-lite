import Vue from "vue";
import VueRouter from "vue-router";
// import { store } from "../store";

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

// const protectedRoutes = ["home"];

// router.beforeEach((to, from, next) => {
// 	if (!protectedRoutes.includes(to.name)) {
// 		next();
// 	} else if (store.state.accessToken != null) {
// 		next();
// 	} else {
// 		console.log("fragged");
// 		window.location.href = "/login";
// 	}
// });