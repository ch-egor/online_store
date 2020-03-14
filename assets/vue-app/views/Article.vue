<template>
  <div v-if="article">
    <h2>{{ article.title }}</h2>
    <p>Category: {{ article.category.title }}</p>
    <p>In stock: {{ article.inStock ? 'Yes' : 'No' }}</p>
    <p>{{ article.description }}</p>
  </div>
</template>

<script>
  import articleApi from "../api/article";

  export default {
    name: "Article",
    data() {
      return {
        article: null
      };
    },
    methods: {
      async initArticle() {
        const id = this.$route.params.id;
        const response = await articleApi.getById(id);

        this.article = response.data;
      }
    },
    mounted() {
      this.initArticle();
    },
    beforeRouteUpdate(to, from, next) {
      next();
      this.initArticle();
    }
  }
</script>

<style scoped lang="scss">

</style>