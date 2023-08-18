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
      <div
        :class="
          navigation.edit === 'departure' ? 'location selected' : 'location'
        "
      >
        <DetailsComponent
          v-if="navigation.departure"
          :location="navigation.departure"
          @clearLocation="clearDeparture"
          @editLocation="editLocation"
        ></DetailsComponent>
        <div v-else class="mainGate">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            height="1em"
            viewBox="0 0 384 512"
          >
            <path
              d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"
            />
          </svg>
          Main Entrance
        </div>
        <span class="edit">
          <svg
            @click="setEdit('departure')"
            xmlns="http://www.w3.org/2000/svg"
            height="1em"
            viewBox="0 0 512 512"
          >
            <path
              d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"
            />
          </svg>
        </span>
      </div>
    </div>
    <div class="swap" @click="swap()">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        height="1em"
        viewBox="0 0 576 512"
      >
        <path
          d="M272 416c17.7 0 32-14.3 32-32s-14.3-32-32-32H160c-17.7 0-32-14.3-32-32V192h32c12.9 0 24.6-7.8 29.6-19.8s2.2-25.7-6.9-34.9l-64-64c-12.5-12.5-32.8-12.5-45.3 0l-64 64c-9.2 9.2-11.9 22.9-6.9 34.9s16.6 19.8 29.6 19.8l32 0 0 128c0 53 43 96 96 96H272zM304 96c-17.7 0-32 14.3-32 32s14.3 32 32 32l112 0c17.7 0 32 14.3 32 32l0 128H416c-12.9 0-24.6 7.8-29.6 19.8s-2.2 25.7 6.9 34.9l64 64c12.5 12.5 32.8 12.5 45.3 0l64-64c9.2-9.2 11.9-22.9 6.9-34.9s-16.6-19.8-29.6-19.8l-32 0V192c0-53-43-96-96-96L304 96z"
        />
      </svg>
    </div>
    <div>
      <h5>Destination</h5>
      <div
        :class="
          navigation.edit === 'destination' ? 'location selected' : 'location'
        "
      >
        <DetailsComponent
          :location="navigation.destination"
          @clearLocation="clearDestination"
          @editLocation="editLocation"
        ></DetailsComponent>
        <span class="edit" @click="setEdit('destination')">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            height="1em"
            viewBox="0 0 512 512"
          >
            <path
              d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"
            />
          </svg>
        </span>
      </div>
      <div class="options">
        <input
          type="checkbox"
          name="disabled"
          class="checkbox"
          v-model="isChecked"
          @change="toggleDisabled"
        /><label for="disabled">Wheelchair Accessible</label>
      </div>
    </div>
    <div class="details">
      <h5 v-if="navigation">Distance</h5>
      <span v-if="navigation.distance != null">
        {{ navigation.distance.distance }} {{ navigation.distance.metric }}
      </span>
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
          departure: null,
          destination: this.location,
          edit: "destination",
          location: this.location,
          distance: 0,
          nodeIds: [],
          path: [],
        },
      };
    },
    props: {
      location: {
        type: Object,
        required: false,
      },
      locations: {
        type: Array,
        required: false,
      },
      connections: {
        type: Array,
        required: false,
      },
      entrance: {
        type: Object,
        required: false,
      },
    },
    watch: {
      location: {
        deep: true,
        handler(newVal) {
          if (this.navigation.edit === "departure") {
            this.navigation.departure = newVal;
          } else if (this.navigation.edit === "destination") {
            this.navigation.destination = newVal;
          }
        },
      },
      locations: {
        deep: true,
        handler(newVal) {
          this.navigation.location = newVal;
        },
      },
      entrance: {
        deep: true,
        handler(newVal) {
          this.navigation.entrance = newVal;
        },
      },
      connections: {
        deep: true,
        handler(newVal) {
          this.navigation.connections = newVal;
        },
      },
    },
    methods: {
      navigate() {
        // Ensure the route is valid
        if (this.navigation.destination === this.navigation.departure) {
          alert("Please select a destination");
          return;
        }
        // If no departure is selected, select the closest node
        if (this.navigation.departure == null) {
          try {
            this.navigation.departure = this.entrance;
          } catch (err) {
            this.navigation.departure = getClosestNode(
              this.locations,
              52.82866813716404,
              -6.936708227680724,
              0
            );
            console.log(err);
          }
        }

        // Initiate search
        let output = search(
          this.locations,
          this.connections,
          this.navigation.departure,
          this.navigation.destination,
          this.navigation.disabled
        );

        // If no route is found, alert the user
        if (output === [] || output === null || output === undefined) {
          alert("No Route found");
          return;
        }

        // Update the navigation object
        [
          this.navigation.distance,
          this.navigation.nodeIds,
          this.navigation.path,
        ] = output;
        this.updatePath();
      },
      setEdit(edit) {
        if (edit === this.navigation.edit) {
          this.navigation.edit = "";
        } else {
          this.navigation.edit = edit;
        }
      },
      toggleDisabled() {
        this.navigation.disabled = !this.navigation.disabled;
      },
      clearDeparture() {
        try {
          this.navigation.departure = this.entrance;
        } catch (err) {
          this.navigation.departure = getClosestNode(
            this.locations,
            52.82866813716404,
            -6.936708227680724,
            0
          );
          console.log(err);
        }
      },
      swap() {
        let temp = this.navigation.departure;
        this.navigation.departure = this.navigation.destination;
        this.navigation.destination = temp;
      },
      clearDestination() {
        this.navigation.destination = null;
      },
      updatePath() {
        this.$emit("updatePath", [
          this.navigation.path,
          this.navigation.nodeIds,
        ]);
      },
      setup() {
        watch(
          () => this.location,
          (newVal) => {
            this.navigation.departure = newVal;
          },
          { deep: true }
        );
      },
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
    .swap {
      text-align: end;
      svg {
        height: 1.5em;
        width: 1.5em;
        fill: $txt-1;
        cursor: pointer;
        transition: $tr-f;
        &:hover {
          fill: $acc-1;
        }
      }
    }
    .mainGate {
      display: flex;
      align-items: center;
      svg {
        margin: 1em;
        height: 1.7em;
      }
    }
    .location {
      border: 2px solid white;
      border-radius: $rad-1;

      &.selected {
        border: 2px solid $acc-1;
      }
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
    .edit {
      position: absolute;
      top: 0em;
      right: 0em;
      cursor: pointer;
      background-color: $bg-1;
      font-size: 1.3em;
      z-index: 2;
      font-weight: bold;
      border-radius: 0 $rad-1 0 0;
      padding: 0.1em 0.5em;
      transition: $tr-f;
      &:hover {
        fill: $acc-1;
      }
    }
    h5 {
      color: $acc-2;
    }
    .options {
      margin: 1em;
      .checkbox {
        height: 1.1em;
        width: 1.1em;
        margin-right: 0.5em;
      }
      label {
        font-size: 1.1em;
      }
    }
  }
</style>
