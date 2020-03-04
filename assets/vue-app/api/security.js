import axios from 'axios';

export default {
  login(username, password) {
    return axios.post('/api/login');
  },

  logout() {
    return axios.get('/logout');
  },

  userInfo() {
    return axios.post('/api/user_info');
  }
};