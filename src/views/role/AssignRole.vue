<template>
  <div class="home">
    <div class="container">
      <Navbar />

      <div class="create-role mt-3">
        <h5>Create role</h5>

        <form @submit.prevent="assignRole" class="mt-2">
          <div class="row">
            <div class="col-md-6 mx-auto">
              <div class="mb-3">
                <label class="form-label">Select user</label>
                <select class="form-control" v-model="assignedRole.user_id"> 
                  <option value="" seleced>Select a user</option>
                  <option
                    v-for="(user, i) in users"
                    :key="i"
                    :value="user.id"
                  >{{ `${user.first_name} ${user.last_name}` }}</option>
                </select>
                <div
                  class="invalid-feedback d-block"
                  v-if="errors && errors.user_id"
                  role="alert"
                >{{ errors.user_id[0] }}</div>
              </div>
              <div class="mb-3">
                <label class="form-label">Select role</label>
                <select class="form-control" v-model="assignedRole.role_id">
                <option value="" seleced>Select a role</option>
                  <option
                   v-for="(role, i) in roles" 
                   :key="i" 
                   :value="role.id">{{ role.name }}
                   </option>
                </select>
                <div
                  class="invalid-feedback d-block"
                  v-if="errors && errors.role_id"
                  role="alert"
                >{{ errors.role_id[0] }}</div>
              </div>
              <div class="mb-3 mt-4">
                <button type="submit" class="btn btn-primary w-100">Save</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import Navbar from "@/components/Navbar";
import axios from "../../axios";

export default {
  name: "AssignRole",
  components: { Navbar },
  data() {
    return {
      users: "",
      roles: "",
      assignedRole: {
          user_id: "",
          role_id: "",
      },
      errors: {},
    };
  },
  methods: {
    getUsrs() {
      axios.get("/api/users").then(res => {
        this.users = res.data.results;
      });
    },
    getRoles() {
      axios.get("/api/roles").then(res => {
            if(res.data.success == true) {
        this.roles = res.data.results;
            }
      });
    },
     assignRole() {
      axios
        .post("/api/user/role/update", this.assignedRole)
        .then(res => {
          if (res.data.success == true) {
            // eslint-disable-next-line no-undef
            toastr.success("Role assigned successfully");
            this.$router.push({ name: "Users" });
          }
        })
        .catch(err => {
          this.errors = err.response.data.errors;
        });
    },
  },
  created() {
    this.getUsrs();
    this.getRoles();
  }
};
</script>
