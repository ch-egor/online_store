import axios from 'axios';

export default {
  get() {
    return axios.get('/api/article');
  },

  getById(id) {
    return axios.get(`/api/article/${id}`);
  }
};