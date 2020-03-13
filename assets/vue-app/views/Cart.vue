<template>
  <div class="row">
    <div class="col-12">
      <h1>Cart</h1>
      <p v-if="itemCount === 0">The cart is empty.</p>
    </div>
    <div class="col-sm-4" v-for="item in items" :key="item.id" v-if="itemCount > 0">
      <ArticlePreview :object="item.article"/>
    </div>
  </div>
</template>

<script>
  import {mapGetters, mapState} from "vuex";
  import ArticlePreview from "../components/ArticlePreview";

  export default {
    name: "Cart",
    components: {
      ArticlePreview
    },
    computed: {
      ...mapState({
        items: state => state.order.order.orderItems,
      }),
      ...mapGetters(['itemCount']),
    }
  }
</script>

<style scoped lang="scss">

</style>