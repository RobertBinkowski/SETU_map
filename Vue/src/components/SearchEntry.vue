<template>
  <div class="border">
    <a href="">
      <strong v-show="data.name">{{ data.name }}</strong>
      - {{ data.type }}
    </a>
  </div>
</template>

<script>
  import { watch } from "vue";

  export default {
    setup(props) {
      watch([() => props.data]);
    },
    props: {
      data: {
        required: false,
      },
    },
  };
</script>

<style lang="scss" scoped>
  @import "@/assets/variables.scss";
  .border {
    border-radius: $rad-1;
    margin: auto;
    margin-top: 0.5em;
    max-width: 50em;
    background-color: $bg-1;
    overflow: hidden;
    text-align: center;
    padding: 0;
    a {
      display: block;
      width: 100%;
      color: gray;
      padding: 1em;
      strong {
        color: $acc-2;
      }
      &:hover {
        background-color: $bg-2;
      }
    }
  }
</style>
