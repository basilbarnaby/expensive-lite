import Vue from "vue";
import VueProgressBar from "vue-progressbar";
Vue.use(VueProgressBar, {
	color: "rgb(143, 255, 199)",
	failedColor: "red",
	height: "100px"
});

export default VueProgressBar;