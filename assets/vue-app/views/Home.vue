<template>
  <div class="home">
    <ul>
      <li v-for="category in categories">{{ category.title }}</li>
    </ul>

    <img alt="Vue logo" src="../assets/logo.png">
    <HelloWorld msg="Welcome to Your Vue.js App"/>
  </div>
</template>

<script>
  import categoryApi from '../api/category';
  import HelloWorld from '../components/HelloWorld.vue';

  export default {
    name: 'home',
    components: {
      HelloWorld
    },
    data() {
      return {
        categories: []
      }
    },
    methods: {
      async initCategories() {
        const response = await categoryApi.get();
        this.categories = response.data;
      }
    },
    mounted() {
      this.initCategories();
    }
  };
</script>

<style scoped lang="scss">

</style>
