<template>
  <form class="form-signin">
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>

    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus
           v-model="username">

    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" class="form-control mb-3" placeholder="Password" required
           v-model="password">

    <button class="btn btn-lg btn-primary btn-block" type="submit" @click.prevent="signIn">Sign in</button>
  </form>
</template>

<script>
  export default {
    name: "SignIn",
    data() {
      return {
        username: '',
        password: ''
      };
    },
    methods: {
      async signIn() {
        await this.$store.dispatch('signIn', {
          username: this.username,
          password: this.password
        });
        this.$router.replace('/');
      }
    }
  }
</script>

<style scoped>
  .form-signin {
    width: 100%;
    max-width: 330px;
    padding: 15px;
    margin: auto;
  }

  .form-signin .form-control {
    position: relative;
    box-sizing: border-box;
    height: auto;
    padding: 10px;
    font-size: 16px;
  }

  .form-signin .form-control:focus {
    z-index: 2;
  }

  .form-signin input[type="email"] {
    margin-bottom: -1px;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
  }

  .form-signin input[type="password"] {
    margin-bottom: 10px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
  }
</style>
