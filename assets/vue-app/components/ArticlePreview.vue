<template>
  <div>
    <h2>{{ object.title }}</h2>
    <p>{{ object.description }}</p>
    <p>
      <router-link :to="{ name: 'article', params: { id: object.id } }" class="btn btn-secondary">
        View details »
      </router-link>
    </p>
  </div>
</template>

<script>
  export default {
    name: "ArticlePreview",
    props: ['object']
  }
</script>

<style scoped lang="scss">

</style>