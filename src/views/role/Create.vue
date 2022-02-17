<template>
  <div class="role">
    <div class="container">
      <Navbar />

      <div class="create-role mt-3">
        <h5>Create role</h5>
        <form @submit.prevent="addRole" class="mt-2">
          <div class="row">
            <div class="col-md-6 mx-auto">
              <div class="mb-3">
                <label class="form-label">Role name</label>
                <input type="text" v-model="role.name" class="form-control" />
                <div
                  class="invalid-feedback d-block"
                  v-if="errors && errors.name"
                  role="alert"
                >{{ errors.name[0] }}</div>
              </div>
              <div class="mb-3">
                <label class="form-label">Role permission</label>
                <div class="form-check form-switch">
                  <label class="form-check-label" for="order">Orders</label>
                  <input
                    class="form-check-input"
                    type="checkbox"
                    v-model="role.permissions"
                    role="switch"
                    id="order"
                    value="1"
                  />
                </div>
                <div class="form-check form-switch">
                  <label class="form-check-label" for="products">Orders</label>
                  <input
                    class="form-check-input"
                    type="checkbox"
                    v-model="role.permissions"
                    role="switch"
                    id="products"
                    value="2"
                  />
                </div>
                <div class="form-check form-switch">
                  <label class="form-check-label" for="customers">Customers</label>
                  <input
                    class="form-check-input"
                    type="checkbox"
                    v-model="role.permissions"
                    role="switch"
                    id="customers"
                    value="3"
                  />
                </div>
                <div
                  class="invalid-feedback d-block"
                  v-if="errors && errors.permissions"
                  role="alert"
                >{{ errors.permissions[0] }}</div>
              </div>
              <div class="mb-3 mt-5">
                <button type="submit" class="btn btn-primary w-100">Save</button>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="all-roles mt-5">
        <h5>All role</h5>

        <div class="row">
          <div class="col-md-6 mx-auto">
            <table class="table mt-3">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Role name</th>
                  <th scope="col">Role permissions</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(role, i) in roles" :key="i">
                  <th>{{ i + 1 }}</th>
                  <td>{{ role.name }}</td>
                  <td>{{ role.permissions }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import Navbar from "@/components/Navbar";
import axios from "../../axios";

export default {
  name: "RoleCreate",
  components: { Navbar },
  data() {
    return {
      role: {
        name: "",
        permissions: []
      },
      errors: {},
      roles: []
    };
  },
  methods: {
    addRole() {
      axios
        .post("/api/role/create", this.role)
        .then(res => {
          if (res.data.success == true) {
            // eslint-disable-next-line no-undef
            toastr.success("Role created successfully");
          }
        })
        .catch(err => {
          this.errors = err.response.data.errors;
        });
    },
    getRole() {
      axios.get("/api/roles").then(res => {
          if(res.data.success == true) {
              this.roles = res.data.results;
             console.log("this.roles", res);
          }
        
      });
    }
  },
  created() {
    this.getRole();
  }
  //   updated() {
  //       this.getRole();
  //   }
};
</script>
