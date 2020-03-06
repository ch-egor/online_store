<template>
  <div>
    <h2>{{ object.title }}</h2>
    <p>{{ object.description }}</p>
    <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
  </div>
</template>

<script>
  export default {
    name: "Article",
    props: ['object']
  }
</script>

<style scoped lang="scss">

</style>