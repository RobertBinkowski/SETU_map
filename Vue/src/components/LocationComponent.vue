<template>
  <section id="locationComponent">
    <!-- <h1>{{ location.name }}</h1> -->
  </section>
</template>

<script>
  export default {
    props: { locations: { required: true } },
  };
</script>

<style lang="scss" scoped>
  @import "@/assets/variables.scss";
</style>
