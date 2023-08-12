<template>
  <div v-if="location" id="locationDetails" :class="large ? '' : 'maxHeight'">
    <span class="resize" @click="resizeToggle">
      <svg
        v-if="large"
        xmlns="http://www.w3.org/2000/svg"
        height="1em"
        viewBox="0 0 512 512"
      >
        <path
          d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"
        />
      </svg>
      <svg
        v-else
        xmlns="http://www.w3.org/2000/svg"
        height="1em"
        viewBox="0 0 448 512"
      >
        <path
          d="M201.4 137.4c12.5-12.5 32.8-12.5 45.3 0l160 160c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L224 205.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l160-160z"
        />
      </svg>
    </span>
    <!-- Details -->
    <div v-if="location.details" class="image" @click="resizeToggle">
      <img :src="location.details.src" :alt="location.details.name" />
    </div>
    <div v-if="location" class="details">
      <h1 class="name" v-if="location.details && location.details.name">
        {{ location.details.name }}
      </h1>
      <p v-if="location.floor && location.floor.floor" class="floor">
        Floor: {{ location.floor.floor }}
      </p>
      <span v-if="location.building && location.building.details" class="floor">
        Building: {{ location.building.details.name }}
      </span>
      <span
        class="abbreviation"
        v-if="location.details && location.details.abbreviation"
        >{{ location.abbreviation }}</span
      >
      <span
        v-if="location.details && location.building.details"
        class="building"
        >{{ location.building.details.name }}</span
      >
      <p v-if="location.details && location.details.info" class="info">
        {{ location.details.info }}
      </p>
    </div>
    <!-- Options -->
    <span class="clear" @click="clearLocation">
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
    <span class="edit" @click="editLocation">
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
  <div v-else id="locationDetails" class="maxHeight"></div>
</template>

<script>
  import axios from "axios";
  import { ref, watch } from "vue";

  export default {
    data() {
      return {
        large: false,
      };
    },
    props: {
      location: {
        type: Object,
        required: true,
      },
    },
    methods: {
      resizeToggle() {
        // resize the details component
        this.large = !this.large;
      },
      clearLocation() {
        this.$emit("clearLocation");
      },
      editLocation() {
        this.$emit("editLocation");
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
    position: inherit;
    overflow: hidden;
    font-weight: bold;
    box-shadow: $shadow;
    border-radius: $rad-1;
    color: $txt-2;
    transition: $tr-s;
    &.maxHeight {
      height: 4em;
      .image {
        height: 4em;
        opacity: 0.3;
      }
      .name {
        position: absolute;
        left: 0.5em;
        top: -1.3em;
      }
    }
    .resize,
    .clear,
    .edit {
      position: absolute;
      top: 0em;
      cursor: pointer;
      background-color: $bg-1;
      font-size: 1.3em;
      z-index: 2;
      font-weight: bold;
      text-shadow: 0 0 3px $txt-2, 0 0 5px $txt-2;
      transition: $tr-f;
      &.clear {
        right: 1.9em;
        bottom: auto;
        padding: 0.1em 0.5em;
        &:hover {
          fill: $close;
        }
      }
      &.resize {
        right: 0em;
        padding: 0.1em 0.5em;
        &:hover {
          fill: $acc-1;
        }
      }
      &.edit {
        border-radius: 0 0 0 $rad-1;
        right: 3.6em;
        padding: 0.1em 0.5em;
        &:hover {
          fill: $acc-1;
        }
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
      transition: $tr-s;
      cursor: pointer;
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
