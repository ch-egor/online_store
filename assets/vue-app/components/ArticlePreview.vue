<template>
  <div>
    <h2>{{ object.title }}</h2>
    <p>{{ shortDescription }}</p>
    <p><router-link :to="{ name: 'article', params: { id: object.id } }">View details »</router-link></p>
    <p v-if="isLoggedIn">
      <button type="button" class="btn btn-light" @click="incrementItem">+</button>
      <i class="fas fa-shopping-cart"></i>
      {{ quantity }}
      <button type="button" class="btn btn-light" @click="decrementItem" :disabled="quantity <= 0">-</button>
      <button type="button" class="btn btn-danger" @click="removeItem" :disabled="quantity <= 0">Remove</button>
    </p>
  </div>
</template>

<script>
  import {mapGetters} from "vuex";

  export default {
    name: "ArticlePreview",
    props: ['object'],
    methods: {
      incrementItem() {
        this.$store.dispatch('updateItem', {
          article: this.object,
          quantity: this.quantity + 1
        });
      },

      decrementItem() {
        this.$store.dispatch('updateItem', {
          article: this.object,
          quantity: this.quantity - 1
        });
      },

      removeItem() {
        this.$store.dispatch('removeItem', {
          article: this.object
        });
      },
    },
    computed: {
      ...mapGetters(['isLoggedIn']),

      shortDescription() {
        const description = this.object.description;
        return description.length <= 200 ? description : description.substr(0, 200) + '…';
      },

      quantity() {
        return this.$store.getters.getArticleQuantity(this.object);
      },
    }
  }
</script>

<style scoped lang="scss">

</style>