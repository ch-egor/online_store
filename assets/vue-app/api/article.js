import axios from 'axios';

export default {
  get(category = null) {
    return axios.get('/api/article', {
      params: { category }
    });
  },

  getById(id) {
    return axios.get(`/api/article/${id}`);
  }
};