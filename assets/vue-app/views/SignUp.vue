<template>
  <form class="form-signin">
    <h1 class="h3 mb-3 font-weight-normal">Please sign up</h1>
    <div class="text-danger" v-show="isError">An error occurred.</div>

    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus
           v-model="email" @input="resetError">

    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" class="form-control mb-3" placeholder="Password" required
           v-model="password" @input="resetError">

    <button class="btn btn-lg btn-primary btn-block" type="submit" @click.prevent="signUp">Sign up</button>
  </form>
</template>

<script>
  import securityApi from "../api/security";

  export default {
    name: "SignUp",
    data() {
      return {
        isError: false,
        email: '',
        password: ''
      };
    },
    methods: {
      async signUp() {
        const response = await securityApi.signUp(this.email, this.password);

        if (response.data.success === true) {
          this.$router.replace({name: 'signIn'});
        } else {
          this.isError = true;
        }
      },

      resetError() {
        this.isError = false;
      }
    }
  }
</script>

<style scoped lang="scss">
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