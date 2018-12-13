<template>
  <div>
    <h4>
      <div class="row">
        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <form @submit.prevent="login">
                <div class="form-row mb-3">
                  <div class="col-md-12">
                    <input v-model="form.email" type="text" name="email"
                      class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                    <has-error :form="form" field="email"></has-error>
                  </div>
                </div>
                <div class="form-row mb-4">
                  <div class="col-md-12">
                    <input v-model="form.password" type="password" name="password"
                      class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                    <has-error :form="form" field="password"></has-error>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-md-12">
                    <button class="btn btn-outline-primary btn-block" type="submit">Login</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </h4>
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
    }
  },
  methods: {
    login(){
      this.form.post("/api/login")
        .then(response => {
          localStorage.setItem('accessToken', response.data.auth.access_token);
          localStorage.setItem('user', JSON.stringify(response.data.user));
        })
        .catch(error =>{console.log(error)});
    }
  }
};
</script>
