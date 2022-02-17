<template>
  <div class="profile">
    <div class="container">
      <Navbar />
      <div class="profile-information mt-3">
          <h5> Welcome to your profile {{ `${profileData.first_name} ${profileData.last_name}`  }} </h5>
        <table class="table table-bordered">
          <tbody>
            <tr>
              <th>First name</th>
              <td> {{ profileData.first_name }} </td>
            </tr>
            <tr>
              <th>Last name</th>
              <td> {{ profileData.last_name }} </td>
            </tr>
            <tr>
              <th>Email</th>
              <td> {{ profileData.email }} </td>
            </tr>
            <tr>
              <th>Phone</th>
              <td> {{ profileData.phone }} </td>
            </tr>
            <tr>
              <th>Role</th>
              <td> {{ profileData.role_name ? profileData.role_name : 'Not seleced'  }} </td>
            </tr>
            <tr>
              <th>Country</th>
              <td> {{ profileData.country }} </td>
            </tr>
            <tr>
              <th>State</th>
              <td> {{ profileData.state }} </td>
            </tr>
            <tr>
              <th>Zip code</th>
              <td> {{ profileData.zip_code }} </td>
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
import axios from '../axios';

export default {
  name: "Profile",
  components: { Navbar },
    data() {
    return {
      profileData : "",
    };
  },
  methods : {
      getProfileInformation() {
          axios.get("/api/user/profile")
          .then(res => {
              this.profileData = res.data.results;
              console.log(res.data.results);
          })
          .catch(err => {
                console.log("profile information err", err);
          })
      }
  },
  created() {
      this.getProfileInformation();
  }

};
</script>

<style scoped>
    tr th {
        width: 20%;
    }
</style>
