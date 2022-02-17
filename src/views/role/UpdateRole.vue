<template>
  <div class="home">
    <div class="container">
      <Navbar />

      <div class="create-role mt-3">
        <h5>Update role for {{ fullName }}</h5>

        <form @submit.prevent="assignRole" class="mt-5">
          <div class="row">
            <div class="col-md-6 mx-auto">
              <div class="mb-3">
                <label class="form-label">Select role</label>
                <select class="form-control" v-model="role_id">
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
  name: "UpdateRole",
  components: { Navbar },
  data() {
    return {
      user: "",
      roles: "",
      user_id : '',
      role_id: "",
      errors: {},
    };
  },
  methods: {
    getUser(user_id) {
      axios.get(`/api/single/user/${user_id}`).then(res => {
        this.user = res.data.results;
        this.role_id = res.data.results.role_id;
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
        .post("/api/user/role/update", { "user_id" : this.user.id, "role_id": this.role_id })
        .then(res => {
          if (res.data.success == true) {
            // eslint-disable-next-line no-undef
            toastr.success("Role update successfully");
            this.$router.push({ name: "Users" });
          }
        })
        .catch(err => {
            if(err.response.status === 401) {
                this.checkError(err);
            }else {
                this.errors = err.response.data.errors;
            }
        });
    },
  },
  created() {
    this.getUser(this.$route.params.id);
    this.getRoles();
  },
   computed : {
    fullName() {
      return this.user.first_name + ' ' + this.user.last_name;
    }
  }
};
</script>
