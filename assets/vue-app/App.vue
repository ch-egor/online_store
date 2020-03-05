<template>
  <div id="app">
    <Navbar/>

    <main role="main" class="container mt-5">
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
    mounted() {
      this.$store.dispatch('getUserInfo');
    }
  };
</script>

<style lang="scss">
</style>
