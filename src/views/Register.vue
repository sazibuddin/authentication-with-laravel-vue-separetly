<template>
  <div class="register">
    <div class="container">
      <div class="register-form">
        <div class="card">
          <div class="card-header">
            <h5 class="text-center">Login</h5>
          </div>
          <div class="card-body">
            <form @submit.prevent="register">
              <div class="mb-3">
                <label class="form-label">First name</label>
                <input type="text" v-model="userData.first_name" class="form-control" />
                <div
                  class="invalid-feedback d-block"
                  v-if="errors && errors.first_name"
                  role="alert"
                >{{ errors.first_name[0] }}</div>
              </div>
              <div class="mb-3">
                <label class="form-label">Last name</label>
                <input type="text" v-model="userData.last_name" class="form-control" />
                <div
                  class="invalid-feedback d-block"
                  v-if="errors && errors.last_name"
                  role="alert"
                >{{ errors.last_name[0] }}</div>
              </div>
              <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" v-model="userData.email" class="form-control" />
                <div
                  class="invalid-feedback d-block"
                  v-if="errors && errors.email"
                  role="alert"
                >{{ errors.email[0] }}</div>
              </div>
              <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" v-model="userData.phone" class="form-control" />
                <div
                  class="invalid-feedback d-block"
                  v-if="errors && errors.phone"
                  role="alert"
                >{{ errors.phone[0] }}</div>
              </div>
              <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" v-model="userData.password" class="form-control" />
                <div
                  class="invalid-feedback d-block"
                  v-if="errors && errors.password"
                  role="alert"
                >{{ errors.password[0] }}</div>
              </div>
              <div class="mb-3">
                <label class="form-label">Confirm oassword</label>
                <input
                  type="password"
                  v-model="userData.password_confirmation"
                  class="form-control"
                />
                <div
                  class="invalid-feedback d-block"
                  v-if="errors && errors.password_confirmation"
                  role="alert"
                >{{ errors.password_confirmation[0] }}</div>
              </div>
              <button type="submit" class="btn btn-primary w-100">Register</button>
              <p class="text-center mt-3">
                Already user?
                <router-link :to="{ name: 'Login' }">Login</router-link>
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
  name: "Register",
  data() {
    return {
      userData: {
        first_name: "",
        last_name: "",
        email: "",
        phone: "",
        password: "",
        password_confirmation: ""
      },
      errors: {}
    };
  },
  methods: {
    register() {
      axios
        .post("/api/register", this.userData)
        .then(res => {
          console.log("register data", res);
          localStorage.setItem("token", res.data.results.token);
          window.location.href = "/";
        })
        .catch(err => {
          this.errors = err.response.data.errors;
          if (err.response.status == 401) {
            // eslint-disable-next-line no-undef
            toastr.error("Failed to register, please try again");
          }
        });
    }
  }
};
</script>

<style scoped lang="scss">
.register-form {
  height: 100vh;
}
.register-form {
  display: flex;
  justify-content: center;
  align-items: center;
}
.card-body {
  width: 400px;
}
</style>
