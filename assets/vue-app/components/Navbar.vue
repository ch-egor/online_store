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
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown"
             aria-haspopup="true" aria-expanded="false">Categories</a>
          <div class="dropdown-menu" aria-labelledby="dropdown01">
            <router-link v-for="category in categories" class="dropdown-item"
                         :to="{ name: 'category', params: { id: category.id } }"
                         :key="category.id">
              {{ category.title }}
            </router-link>
          </div>
        </li>
        <li class="nav-item">
          <router-link class="nav-link" :to="{ name: 'about' }" exact-active-class="active">About</router-link>
        </li>
      </ul>

      <ul class="navbar-nav">
        <li class="nav-item" v-if="!isLoggedIn">
          <router-link class="nav-link" :to="{ name: 'signUp' }" exact-active-class="active">Sign Up</router-link>
        </li>
        <li class="nav-item" v-if="!isLoggedIn">
          <router-link class="nav-link" :to="{ name: 'signIn' }" exact-active-class="active">Sign In</router-link>
        </li>

        <li class="nav-item" v-if="isLoggedIn">
          <router-link class="nav-link" :to="{ name: 'cart' }" exact-active-class="active">
            <i class="fas fa-shopping-cart"></i>
          </router-link>
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
  import categoryApi from '../api/category';

  export default {
    name: "Navbar",
    data() {
      return {
        categories: []
      }
    },
    methods: {
      async initCategories() {
        const response = await categoryApi.get();
        this.categories = response.data;
      },

      async signOut() {
        await this.$store.dispatch('signOut');
        this.$router.push('/');
      }
    },
    computed: {
      ...mapState({
        username: state => state.security.username
      }),
      ...mapGetters(['isLoggedIn'])
    },
    mounted() {
      this.initCategories();
    }
  };
</script>

<style scoped lang="scss">

</style>
