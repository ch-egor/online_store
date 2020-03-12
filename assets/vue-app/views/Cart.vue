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
  import {mapActions, mapState} from "vuex";

  export default {
    name: "Cart",
    computed: {
      ...mapState({
        items: state => state.order.order.orderItems,
      }),
    },
    methods: {
      ...mapActions(['removeItem']),
    }
  }
</script>

<style scoped lang="scss">

</style>