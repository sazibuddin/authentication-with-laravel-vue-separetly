import "bootstrap/dist/css/bootstrap.css"
import Vue from 'vue'
import App from './App.vue'
import router from './router'

window.toastr = require('toastr')


Vue.config.productionTip = false
import './assets/scss/app.scss'

Vue.prototype.checkError = err => {
  const redirectLogPage = () => {
      localStorage.clear();

      window.location.href = "/login";
      location.reload();
  };

  if (err.response.status === 401) {
      redirectLogPage();
  }
};

new Vue({
  router,
  render: h => h(App)
}).$mount('#app')

import "bootstrap/dist/js/bootstrap.js"