<template>
  <div id="navigationDetails">
    <span class="close" @click="$emit('close')">X</span>
    <h1>Navigation</h1>
    <p>
      From: <br />
      <strong v-if="navigation.departure">{{
        navigation.departure.name != null
          ? navigation.departure.name
          : "Entrance"
      }}</strong>
      <strong v-if="!navigation.departure">Select Location on the map</strong>
      <br />
      To: <br />
      <strong v-if="navigation.destination">{{
        navigation.destination.name
      }}</strong>
    </p>
    <p v-if="navigation.distance != null">
      {{ navigation.distance.distance + " " + navigation.distance.metric }}
    </p>
    <br />
    <input
      type="checkbox"
      name="disabled"
      class="checkbox"
      v-model="isChecked"
      @change="$emit('updateDisabled', isChecked)"
    /><label for="disabled">Wheelchair Accessible</label>
    <br />
    <br />
    <button @click="$emit('navigate')">Navigate</button>
  </div>
</template>

<script>
  import { watch } from "vue";

  export default {
    data() {
      return {
        isChecked: false,
        details: "Hello",
      };
    },
    props: {
      navigation: {
        required: false,
      },
    },
    methods: {
      submit() {
        this.$emit("navigate");
        this.$emit("close");
        this.$emit("updateDisabled", this.isChecked);
      },
    },
    setup(props) {
      // Watch for changes
      watch(() => props.navigation);
    },
  };
</script>

<style lang="scss" scoped>
  @import "@/assets/variables.scss";
  #navigationDetails {
    position: fixed;
    z-index: 1000;
    padding: 1em;
    top: 5em;
    left: 2em;
    border-radius: $rad-1;
    background-color: $c-bg-1;
    box-shadow: $shadow;
    width: 30em;
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
    strong {
      font-size: 1.2em;
      color: $acc-2;
      padding: 1em;
    }
    label {
      font-weight: bold;
      margin-left: 1em;
      top: -0.2em;
    }
    .checkbox {
      height: 1.2em;
      width: 1.2em;
    }
  }
</style>
