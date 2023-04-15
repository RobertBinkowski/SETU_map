<template>
  <div
    class="border"
    @click="handleClick"
    :style="{ backgroundColor: hoverColor }"
  >
    <strong v-if="location">{{ location.name }}</strong>
    - {{ location.type }}
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
    border-radius: $rad-1;
    margin: auto;
    margin-top: 0.5em;
    max-width: 50em;
    background-color: $bg-1;
    overflow: hidden;
    text-align: center;
    padding: 1em;

    strong {
      color: $acc-2;
    }
    &:hover {
      cursor: pointer;
      background-color: $acc-2;
    }
  }
</style>
