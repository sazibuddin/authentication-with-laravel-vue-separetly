<template>
  <div class="login">
    <div class="container">
      <div class="login-form">
        <div class="card">
          <div class="card-header">
            <h5 class="text-center">Login</h5>
          </div>
          <div class="card-body">
            <form @submit.prevent="login">
              <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" v-model="credentials.email" class="form-control" />
                <div
                  class="invalid-feedback d-block"
                  v-if="errors && errors.email"
                  role="alert"
                >{{ errors.email[0] }}</div>
              </div>
              <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" v-model="credentials.password" class="form-control" />
                <div
                  class="invalid-feedback d-block"
                  v-if="errors && errors.password"
                  role="alert"
                >{{ errors.password[0] }}</div>
              </div>
              <button type="submit" class="btn btn-primary w-100">Login</button>
              <p class="text-center mt-3">
                don't have account? 
                 <router-link :to="{ name: 'Register' }">
                    Register
                </router-link>
              </p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import axios from "../axios";

export default {
  name: "Login",
  data() {
    return {
      credentials: {
        email: "",
        password: ""
      },
      errors: {}
    };
  },
  methods: {
    login() {
      axios
        .post("/api/login", {
          email: this.credentials.email,
          password: this.credentials.password
        })
        .then(res => {
          localStorage.setItem("token", res.data.results.token);
          window.location.href = "/";
        })
        .catch(err => {
          console.log("login err", err);
          this.errors = err.response.data.errors;
          if (err.response.status == 404) {
            // eslint-disable-next-line no-undef
            toastr.error("Credentials not match! please try again");
          }
        });
    }
  }
};
</script>

<style scoped lang="scss">
.login-form {
  height: 100vh;
}
.login-form {
  display: flex;
  justify-content: center;
  align-items: center;
}
.card-body {
  width: 400px;
}
</style>
