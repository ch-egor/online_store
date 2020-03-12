import securityApi from '../api/security';

export default {
  state: {
    username: null,
  },
  getters: {
    isLoggedIn: state => state.username !== null,
  },
  mutations: {
    updateUserInfo(state, user) {
      state.username = user ? user.username : null;
    },
  },
  actions: {
    async getUserInfo({ commit }) {
      const response = await securityApi.userInfo();
      commit('updateUserInfo', response.data);
    },

    async signIn({ commit }, { username, password }) {
      const response = await securityApi.login(username, password);
      commit('updateUserInfo', response.data);
    },

    async signOut({ commit }) {
      await securityApi.logout();
      commit('updateUserInfo', null);
    },
  }
};