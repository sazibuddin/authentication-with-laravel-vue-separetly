<template>
  <div class="home">
    <div class="container">
        <Navbar />

        <div class="home-data">
          <h1>Welcome, {{ fullName }}</h1>
        </div>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import Navbar from '@/components/Navbar'
import axios from '../axios'

export default {
  name: 'Home',
  components: {Navbar},
  data() {
    return {
      authData : {
        first_name: '',
        last_name: ''
      },
    }
  },
   methods : {
      getAuthUserData() {
          axios.get("/api/user/profile")
          .then(res => {
              this.authData = res.data.results;
          })
          .catch(err => {
             if(err.response.status === 401) {
                this.checkError(err);
            }
          })
      }
  },
  created() {
      this.getAuthUserData();
  },
  computed : {
    fullName() {
      return this.authData.first_name + ' ' + this.authData.last_name;
    }
  }
}
</script>

<style scoped>
.home-data {
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>