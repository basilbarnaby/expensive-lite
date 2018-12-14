<template>
  <div>
    <div class="row h-100 align-items-center justify-content-center login-container">
      <div class="col-md-3">
        <h1 class="text-center font-weight-light">Expensive Lite</h1>
        <div class="card card-no-bg border-0">
          <div class="card-body">
            <form 
              @submit.prevent="login" 
              @keydown="form.onKeydown($event)">
              <div class="form-row mb-3">
                <div class="col-md-12">
                  <input 
                    v-model="form.email" 
                    :class="{ 'is-invalid': form.errors.has('email') }" 
                    type="text"
                    name="email" 
                    class="form-control"
                    placeholder="Email"
                  >
                  <has-error 
                    :form="form" 
                    field="email"
                  />
                </div>
              </div>
              <div class="form-row mb-4">
                <div class="col-md-12">
                  <input 
                    v-model="form.password" 
                    :class="{ 'is-invalid': form.errors.has('password') }" 
                    type="password"
                    name="password" 
                    class="form-control"
                    placeholder="Password"
                  >
                  <has-error 
                    :form="form" 
                    field="password"
                  />
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-12">
                  <button
                    :disabled="form.busy"
                    class="btn btn-outline-primary btn-block border-radius-0" 
                    type="submit"
                  >
                    Login
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <ul class="list-inline text-center">
          <li class="list-inline-item"><small><a href="">Forgot Password</a></small></li>
          <li class="list-inline-item"><small><a href="">Register</a></small></li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
export default {
	name: "Login",
	data() {
		return {
			form: new Form({
				email: null,
				password: null
			})
		};
	},
	created(){
		this.redirectIfAuthenticated();
	},
	methods: {
		redirectIfAuthenticated(){
			if (this.$store.state.accessToken && this.$store.state.user){
				this.$router.push({name: "home"});
			}else{
				localStorage.removeItem("accessToken");
				localStorage.removeItem("user");
			}
		},
		login(){
			this.form.post("/api/login")
				.then(response => {
					localStorage.setItem("accessToken", response.data.auth.access_token);
					localStorage.setItem("user", JSON.stringify(response.data.user));
					this.$store.commit("createSession");
					this.$router.push({name: "home"});
				})
				.catch(error =>{console.log(error);});
		}
	}
};
</script>

<style>
  .login-container {
    height: 100vh !important;
  }

  * {
    border-radius: 0 !important;
  }

  input, input::placeholder{
    text-align: center;
  }
</style>

