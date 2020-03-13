<template>
  <div id="app">
    <Navbar/>

    <main role="main" class="container">
      <router-view/>
    </main><!-- /.container -->
  </div>
</template>

<script>
  import Navbar from './components/Navbar';

  export default {
    components: {
      Navbar
    },
    async mounted() {
      await this.$store.dispatch('getUserInfo');

      if (this.$store.getters.isLoggedIn) {
        this.$store.dispatch('getCurrentOrder');
      }
    }
  };
</script>

<style lang="scss">
  #app > main {
    margin-top: 3.5rem;
  }
</style>
