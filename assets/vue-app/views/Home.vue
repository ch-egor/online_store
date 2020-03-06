<template>
  <div class="row">
    <div class="col-sm-4" v-for="article in articles">
      <ArticlePreview :object="article"/>
    </div>
  </div>
</template>

<script>
  import articleApi from '../api/article';
  import ArticlePreview from "../components/ArticlePreview";

  export default {
    name: 'home',
    components: {
      ArticlePreview
    },
    data() {
      return {
        articles: []
      }
    },
    methods: {
      async initArticles() {
        const response = await articleApi.get();
        this.articles = response.data;
      }
    },
    mounted() {
      this.initArticles();
    }
  };
</script>

<style scoped lang="scss">

</style>
