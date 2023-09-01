<template>
  <div v-if="location.name" class="border" @click="handleClick">
    <img v-show="location.src" :src="location.src" :alt="location.name" />
    <strong v-if="location">{{ location.name }}</strong>
    -
    <span v-if="location.building && location.building.details">
      {{ location.building.details.name }}
    </span>
    <span v-else>Building</span>
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
    },
    data() {
      return {
        hoverColor: "transparent",
      };
    },
    methods: {
      handleClick() {
        this.$emit("selectLocation", this.location);
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

    img {
      position: absolute;
      left: 0em;
      top: 0;
      width: 20em;
      height: 100%;
      object-fit: cover;
      border-radius: $rad-1;
    }

    strong {
      color: $acc-2;
    }

    &:hover {
      cursor: pointer;
      background-color: $acc-1;
    }
  }
</style>
