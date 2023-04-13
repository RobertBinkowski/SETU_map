<template>
  <div v-show="defaults.demo" id="adminPanel">
    <h2>Admin Panel</h2>
    <button @click="updateNodes">Toggle Nodes</button>
  </div>
</template>

<script>
  import { watch } from "vue";

  export default {
    props: {
      defaults: {
        required: true,
      },
    },
    setup(props) {
      watch(() => props.defaults);
    },
    methods: {
      updateNodes() {
        this.$emit("toggle");
      },
    },
  };
</script>

<style lang="scss" scoped>
  @import "@/assets/variables.scss";

  #adminPanel {
    position: fixed;
    border-radius: $rad-1;
    z-index: 200;
    padding: 1em;
    right: 2em;
    top: 3em;
    background: gray;
    color: $acc-1;
    font-size: 1.2em;
    input[type="checkbox"] {
      height: 1em;
      width: 1em;
      margin: 1em;
    }
  }
</style>
