<template>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
            aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <router-link class="nav-link" to="/" exact-active-class="active">Home</router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link" to="/about" exact-active-class="active">About</router-link>
        </li>
      </ul>

      <ul class="navbar-nav">
        <li class="nav-item" v-if="!isLoggedIn">
          <router-link class="nav-link" to="/sign-in" exact-active-class="active">Sign In</router-link>
        </li>
        <li class="nav-item" v-if="isLoggedIn">
          <a class="nav-link">{{ username }}</a>
        </li>
        <li class="nav-item" v-if="isLoggedIn">
          <a href="#" role="button" class="btn-link nav-link" @click.prevent="signOut">Sign Out</a>
        </li>
      </ul>
    </div>
  </nav>
</template>

<script>
  import {mapGetters, mapState} from "vuex";

  export default {
    name: "Navbar",
    methods: {
      async signOut() {
        await this.$store.dispatch('signOut');
        this.$router.push('/');
      }
    },
    computed: {
      ...mapState(['username']),
      ...mapGetters(['isLoggedIn'])
    }
  };
</script>

<style scoped lang="scss">
</style>
