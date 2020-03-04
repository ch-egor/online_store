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
    }
  };
</script>

<style lang="scss">
  .router-link-exact-active {
    color: #fff !important;
  }
</style>
