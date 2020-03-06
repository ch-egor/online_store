<template>
  <div class="row">
    <div class="col-12" v-if="category">
      <h1>{{ category.title }}</h1>
    </div>
    <div class="col-sm-4" v-for="article in articles">
      <ArticlePreview :object="article"/>
    </div>
  </div>
</template>

<script>
  import articleApi from "../api/article";
  import categoryApi from "../api/category";
  import ArticlePreview from "../components/ArticlePreview";

  export default {
    name: "Category",
    components: {
      ArticlePreview
    },
    data() {
      return {
        category: null,
        articles: []
      };
    },
    methods: {
      init() {
        this.initCategory();
        this.initArticles();
      },

      async initCategory() {
        const id = this.$route.params.id;
        const response = await categoryApi.getById(id);

        this.category = response.data;
      },

      async initArticles() {
        const categoryId = this.$route.params.id;
        const response = await articleApi.get(categoryId);

        this.articles = response.data;
      }
    },
    mounted() {
      this.init();
    },
    beforeRouteUpdate() {
      this.init();
    }
  }
</script>

<style scoped lang="scss">

</style>