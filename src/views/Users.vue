<template>
  <div class="home">
    <div class="container">
      <Navbar />
      <div class="profile-information mt-3">
        <h5>All users</h5>
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>First name</th>
              <th>Last name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Role</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(user, i) in users" :key="i">
              <th>{{ i + 1 }}</th>
              <td>{{ user.first_name }}</td>
              <td>{{ user.last_name }}</td>
              <td>{{ user.email }}</td>
              <td>{{ user.phone }}</td>
              <td>{{ user.role_name ? user.role_name : 'not selcted' }}</td>
              <td>
                <div class="btn-group" role="group" aria-label="Basic example">
                  <button
                    type="button"
                    class="btn btn-danger btn-sm rounded-0"
                    @click="removeRole(user.id)"
                    :disabled="user.role_id == null ? true : false"
                  >Remove Role</button>
                    <router-link :to="{ name: 'UpdateRole', params: {id: user.id} }" class="btn btn-primary btn-sm ms-1 rounded-0">
                        Update Role
                    </router-link>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import Navbar from "@/components/Navbar";
import axios from "../axios";

export default {
  name: "Users",
  components: { Navbar },
  data() {
    return {
      users: ""
    };
  },
  methods: {
    getUsrs() {
      axios.get("/api/users").then(res => {
        this.users = res.data.results;
      })
      .catch(err => {
        if(err.response.status === 401) {
            this.checkError(err);
        }
      });
    },
    removeRole(user_id) {
      axios
        .get(`/api/user/role/remove/${user_id}`)
        .then(res => {
          if (res.data.success == true) {
            // eslint-disable-next-line no-undef
            toastr.success("Role removed successfully");
            this.$router.push({ name: "Users" });
          }
        })
        .catch(err => {
          console.log(err);
          // eslint-disable-next-line no-undef
          toastr.success("Failed to remove role");
        });
    }
  },
  created() {
    this.getUsrs();
  }
};
</script>
