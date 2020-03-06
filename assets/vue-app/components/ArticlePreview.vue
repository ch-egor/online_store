<template>
  <div>
    <h2>{{ object.title }}</h2>
    <p>{{ shortDescription }}</p>
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
    props: ['object'],
    computed: {
      shortDescription() {
        const description = this.object.description;
        return description.length < 200 ? description : description.substr(0, 200) + '…';
      }
    }
  }
</script>

<style scoped lang="scss">

</style>