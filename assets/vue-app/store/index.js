import Vue from 'vue';
import Vuex from 'vuex';
import security from './security';
import order from "./order";

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    security,
    order,
  }
});
