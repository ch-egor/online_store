import securityApi from '../api/security';

export default {
  state: {
    username: null
  },
  getters: {
    isLoggedIn: state => state.username !== null
  },
  mutations: {
    updateUserInfo(state, payload) {
      state.username = payload ? payload.username : null;
    }
  },
  actions: {
    async getUserInfo(context) {
      const response = await securityApi.userInfo();
      context.commit('updateUserInfo', response.data);
    },

    async signIn(context, payload) {
      const response = await securityApi.login(payload.username, payload.password);
      context.commit('updateUserInfo', response.data);
    },

    async signOut(context) {
      await securityApi.logout();
      context.commit('updateUserInfo', null);
    }
  }
};