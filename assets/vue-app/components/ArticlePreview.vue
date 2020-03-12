<template>
  <div>
    <h2>{{ object.title }}</h2>
    <p>{{ shortDescription }}</p>
    <p>
      <router-link :to="{ name: 'article', params: { id: object.id } }" class="btn btn-secondary">
        View details »
      </router-link>
      <button type="button" class="btn btn-light" @click="updateItem({ article: object, quantity: 1 })">
        <i class="fas fa-shopping-cart"></i> +1
      </button>
    </p>
  </div>
</template>

<script>
  import {mapActions} from "vuex";

  export default {
    name: "ArticlePreview",
    props: ['object'],
    methods: {
      ...mapActions(['updateItem']),
    },
    computed: {
      shortDescription() {
        const description = this.object.description;
        return description.length <= 200 ? description : description.substr(0, 200) + '…';
      }
    }
  }
</script>

<style scoped lang="scss">

</style>