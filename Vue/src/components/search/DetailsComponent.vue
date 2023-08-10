<template>
  <div id="locationDetails">
    <span class="close" @click="$emit('close')">X</span>
    <div
      v-if="location.details.src != '' && location.details.src != null"
      class="image"
    >
      <img :src="location.details.src" :alt="location.details.name" />
    </div>
    <div v-if="location" class="details">
      <h1 v-if="location.details.name">
        {{ location.details.name }}
      </h1>
      <span v-if="location.details.abbreviation">{{
        location.abbreviation
      }}</span>
      <span v-if="location.building.details" class="building">{{
        location.building.details.name
      }}</span>
      <p v-if="location.details.info" class="info">
        {{ location.details.info }}
      </p>
    </div>
    <div class="options">
      <button @click="$emit('openNavigation', location)">navigate</button>
      <button @click="$emit('setDeparture', location)">set as Departure</button>
    </div>
  </div>
</template>

<script>
  import axios from "axios";
  import { ref, watch } from "vue";

  export default {
    props: {
      location: {
        required: true,
      },
    },
    methods: {
      submit() {
        this.$emit("openNavigation", location);
        this.$emit("setDeparture", location);
        this.$emit("close");
      },
    },
    setup(props) {
      // Watch for changes
      watch(() => props.location);
    },
  };
</script>

<style lang="scss" scoped>
  @import "@/assets/variables.scss";
  #locationDetails {
    position: fixed;
    z-index: 900;
    top: 5em;
    left: 2em;
    border-radius: $rad-1;
    background-color: $c-bg-1;
    box-shadow: $shadow;
    width: 30em;
    padding: 1em;
    overflow: hidden;
    font-weight: bold;
    color: $txt-2;
    .close {
      position: absolute;
      cursor: pointer;
      font-size: 1.3em;
      top: 0.1em;
      right: 0.4em;
      z-index: 2;
      font-weight: bold;
      text-shadow: 0 0 3px $txt-2, 0 0 5px $txt-2;
      transition: $tr-f;
      &:hover {
        color: $close;
      }
    }
    .details {
      padding: 1em;
      text-shadow: $t-shadow;
      .building {
        color: $acc-2;
      }
    }
    .image {
      height: 15em;
      width: 100%;
      overflow: hidden;
      border-radius: $rad-1;
      img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        background-repeat: no-repeat;
        background-size: cover;
      }
    }
  }
</style>
