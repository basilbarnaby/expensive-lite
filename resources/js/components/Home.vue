<template>
  <div><button
    @click="logout">Logout</button></div>
</template>

<script>
export default {
	name: "Home",
	methods: {
		logout(){
			localStorage.removeItem("accessToken");
			localStorage.removeItem("user");
			this.$store.commit("destroySession");
			this.$router.push({name: "login"});
		}
	}
};
</script>
