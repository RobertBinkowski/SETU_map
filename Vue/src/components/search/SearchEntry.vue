<template>
  <div class="border" @click="handleClick">
    <strong v-if="location">{{ location.name }}</strong>
    - {{ location.type ?? "Building" }}
  </div>
</template>
<script>
  import { watch } from "vue";

  export default {
    setup(props) {
      watch([() => props.building, () => props.room]);
    },
    props: {
      location: {
        default: null,
      },
      data: {
        required: false,
      },
    },
    data() {
      return {
        hoverColor: "transparent",
      };
    },
    methods: {
      handleClick() {
        this.$emit("click", this.location);
      },
    },
  };
</script>
<style lang="scss" scoped>
  @import "@/assets/variables.scss";
  .border {
    border: none;
    border-radius: $rad-1;
    margin: auto;
    margin-top: 0.2em;
    max-width: 50em;
    background-color: $c-bg-1;
    overflow: hidden;
    text-align: center;
    padding: 0.5em;
    color: $txt-2;

    strong {
      color: $acc-2;
    }
    &:hover {
      cursor: pointer;
      background-color: $acc-1;
    }
  }
</style>
