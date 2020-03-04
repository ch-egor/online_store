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
          <router-link class="nav-link" to="/" active-class="active">Home</router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link" to="/about" active-class="active">About</router-link>
        </li>
      </ul>

      <ul class="navbar-nav">
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
  import securityApi from "../api/security";

  export default {
    name: "Navbar",
    data() {
      return {
        username: null,

        get isLoggedIn() {
          return this.username !== null;
        },
      }
    },
    methods: {
      async signOut() {
        const response = await securityApi.logout();

        if (response.data.success === true) {
          this.username = null;
        }
      }
    },
    async mounted() {
      const response = await securityApi.userInfo();

      if (response.data !== null) {
        this.$data.username = response.data.username;
      }
    }
  };
</script>

<style scoped lang="scss">
</style>
