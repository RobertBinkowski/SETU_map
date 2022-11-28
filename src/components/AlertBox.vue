<template>
  <div id="alerts">
    <div class="alert alert-dismissible alert-warning fade show" role="alert">
      <strong>{{ alerts }}</strong> {{ alerts }}
      <button
        type="button"
        class="btn-close"
        data-bs-dismiss="alert"
        aria-label="Close"
      ></button>
    </div>
  </div>
</template>

<style scoped lang="scss">
  #alerts {
    margin: auto;
    max-width: 1500px;
  }
</style>

<script>
  export default {
    props: {
      alerts: {
        required: true,
      },
    },
  };
</script>
