import axios from 'axios';

export default {
  getCurrent() {
    return axios.get('/api/order');
  },

  updateItem(articleId, quantity = 1) {
    return axios.post(`/api/order/items/${articleId}`, {
      quantity
    });
  },

  removeItem(articleId) {
    return axios.delete(`/api/order/items/${articleId}`);
  }
};