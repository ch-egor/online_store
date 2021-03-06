import axios from 'axios';

export default {
  login(username, password) {
    return axios.post('/api/login', {
      username,
      password
    });
  },

  logout() {
    return axios.get('/logout');
  },

  userInfo() {
    return axios.post('/api/user_info');
  },

  signUp(email, password) {
    return axios.post('/api/sign_up', {
      email,
      password
    });
  }
};