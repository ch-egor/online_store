import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'

import(/* webpackChunkName: "bootstrap" */'bootstrap');
import(/* webpackChunkName: "bootstrap" */"./bootstrap.scss");
import '@fortawesome/fontawesome-free/js/all';

Vue.config.productionTip = false

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
