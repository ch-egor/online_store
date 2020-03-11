<template>
  <div class="row">
    <div class="col-12">
      <h1>Cart</h1>
    </div>
    <div class="col-sm-4" v-for="item in items" :key="item.id">
      <h2>{{ item.article.title }}</h2>
      <p>Category: {{ item.article.category.title }}</p>
      <p>{{ item.article.description }}</p>
      <p>Quantity: {{ item.quantity }}</p>
      <button type="button" class="btn btn-danger" @click="removeItem(item)">Remove</button>
    </div>
  </div>
</template>

<script>
  import orderApi from "../api/order";

  export default {
    name: "Cart",
    data() {
      return {
        items: []
      };
    },
    methods: {
      async removeItem(item) {
        const response = await orderApi.removeItem(item.article.id);
        this.items.splice(this.items.indexOf(item), 1);

        this.initItems();
      },

      async initItems() {
        const response = await orderApi.getCurrent();
        this.items = response.data.orderItems;
      }
    },
    mounted() {
      this.initItems();
    }
  }
</script>

<style scoped lang="scss">

</style>