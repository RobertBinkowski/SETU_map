<template>
  <div id="navigationDetails">
    <span class="close" @click="$emit('close')">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        height="1em"
        viewBox="0 0 384 512"
      >
        <path
          d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"
        />
      </svg>
    </span>
    <h1>Navigation</h1>
    <div>
      <h5>Departure</h5>
      <div class="location">
        <DetailsComponent
          :location="location"
          @clearLocation="clearDeparture"
          @editLocation="editLocation"
        ></DetailsComponent>
      </div>
    </div>
    <div>
      <h5>Destination</h5>
      <div class="location">
        <DetailsComponent
          :location="departure"
          @clearLocation="clearDestination"
          @editLocation="editLocation"
        ></DetailsComponent>
      </div>
      <div class="options">
        <input
          type="checkbox"
          name="disabled"
          class="checkbox"
          v-model="isChecked"
          @change="$emit('updateDisabled', isChecked)"
        /><label for="disabled">Wheelchair Accessible</label>
      </div>
    </div>
    <div class="details">
      <!-- <span v-if="this.navigation">Distance</span> -->
      <br />
      <h5 v-if="navigation.distance">{{ navigation.distance }} Meters</h5>
      <h5 v-else>0 Meters</h5>
    </div>
    <button @click="navigate">Navigate</button>
  </div>
</template>

<script>
  import { watch } from "vue";

  // Functions
  import { search } from "@/../js/main.js";
  import { getClosestNode } from "@/../js/functions.js";

  // Components
  import DetailsComponent from "./DetailsComponent.vue";

  export default {
    components: { DetailsComponent },
    data() {
      return {
        isChecked: false,
        navigation: {
          disabled: false,
          departure: this.location,
          destination: this.location,
          distance: 0,
          nodeIds: [],
          path: [],
        },
      };
    },
    props: {
      navigation: {
        required: false,
      },
      location: {
        required: false,
      },
    },
    methods: {
      submit() {
        this.$emit("close");
        this.$emit("updateDisabled", this.isChecked);
      },
      navigate() {
        if (this.navigation.departure == null) {
          this.navigation.departure = getClosestNode(this.locations);
        }
        let output = search(
          this.locations,
          this.connections,
          this.navigation.departure,
          this.navigation.destination.location,
          this.navigation.disabled
        );
        if (output === []) {
          alert("No Route found");
          return;
        }
        [
          this.navigation.distance,
          this.navigation.nodeIds,
          this.navigation.path,
        ] = output;
        alert(this.navigation.nodeIds);
      },
      setDepartureLoc(location) {
        this.navigation.departure = location;
        this.selectedLocation = null;
      },
      setDeparture(x = 0, y = 0, z = 0) {
        if (this.navigation.set == false) {
          this.navigation.departure = getClosestNode(this.locations, x, y, z);
        }
      },
      updateWheelchairAccessible(isDisabled) {
        this.navigation.disabled = isDisabled;
      },
      clearDeparture() {
        this.navigation.departure = null;
      },
      clearDestination() {
        this.navigation.destination = null;
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
    .location {
      border: 2px solid $acc-1;
      border-radius: $rad-1;
    }
    .close {
      position: absolute;
      background-color: $bg-1;
      border-radius: 0 0 0 $rad-1;
      cursor: pointer;
      font-size: 1.3em;
      padding: 0.1em 0.5em;
      top: 0em;
      right: 0em;
      z-index: 2;
      font-weight: bold;
      transition: $tr-f;
      svg:hover {
        fill: $close;
      }
    }
    h5 {
      color: $acc-2;
    }
    .options {
      margin: 1em;
      .checkbox {
        height: 1.2em;
        width: 1.2em;
      }
    }
  }
</style>
