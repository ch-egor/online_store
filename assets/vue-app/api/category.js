import axios from 'axios';

export default {
  get() {
    return axios.get('/api/category');
  },

  getById(id) {
    return axios.get(`/api/category/${id}`);
  }
};