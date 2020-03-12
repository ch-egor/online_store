import orderApi from "../api/order";

export default {
  state: {
    order: {
      orderItems: [],
    },
  },
  getters: {
    itemCount: state => state.order.orderItems.length,

    getArticleQuantity: state => article => {
      const item = state.order.orderItems.find(item => item.article.id === article.id);
      return item ? item.quantity : 0;
    },
  },
  mutations: {
    updateOrder(state, order) {
      state.order = order;
    },

    updateItem(state, { article, quantity }) {
      const items = state.order.orderItems;
      const existingItem = items.find(item => item.article.id === article.id);

      if (existingItem) {
        items.splice(items.indexOf(existingItem), 1, { article, quantity });
      } else {
        items.push({ article, quantity });
      }
    },

    removeItem(state, { article }) {
      const items = state.order.orderItems;
      const item = items.find(item => item.article.id === article.id);

      items.splice(items.indexOf(item), 1);
    },
  },
  actions: {
    async getCurrentOrder({ commit }) {
      const response = await orderApi.getCurrent();
      commit('updateOrder', response.data);
    },

    async updateItem({ commit, dispatch }, { article, quantity = 1 }) {
      const response = await orderApi.updateItem(article.id, quantity);
      if (response.data.success === false) {
        throw new Error('An error occurred.');
      }

      commit('updateItem', { article, quantity });
      dispatch('getCurrentOrder');
    },

    async removeItem({ commit, dispatch }, { article }) {
      const response = await orderApi.removeItem(article.id);
      if (response.data.success === false) {
        throw new Error('An error occurred.');
      }

      commit('removeItem', { article });
      dispatch('getCurrentOrder');
    },
  }
};