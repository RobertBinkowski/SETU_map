<template>
  <div v-if="location" id="locationDetails" :class="large ? '' : 'maxHeight'">
    <span class="resize" @click="resizeToggle">
      <svg v-if="large" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
        <path
          d="M201.4 137.4c12.5-12.5 32.8-12.5 45.3 0l160 160c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L224 205.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l160-160z" />
      </svg>
      <svg v-else xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
        <path
          d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
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
      <p>
        <span v-if="location.floor && location.floor.floor" class="floor">
          Floor: {{ location.floor.floor }}
        </span><br>
        <span v-if="location.building && location.building.details" class="building">
          Building: {{ location.building.details.name }}
        </span><br>
        <span class="abbreviation" v-if="location.details && location.details.abbreviation">{{ location.abbreviation
        }}</span>
        <span v-if="location.details && location.details.info" class="info">
          {{ location.details.info }}
        </span>
      </p>
    </div>
    <!-- Options -->
    <span class="clear" @click="clearLocation">
      <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512">
        <path
          d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
      </svg>
    </span>
  </div>
  <div v-else id="locationDetails" class="maxHeight"></div>
</template>

<script>
import { watch } from "vue";

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
  watch: {
    location: {
      deep: true,
      handler() {
        this.large = true;
      },
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
  },
  setup(props) {
    // Watch for changes
    watch(() => props.location);
  },
  setup(props) {
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
      top: -1.5em;
    }
  }

  .resize,
  .clear {
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
      right: 3.6em;
      padding: 0.1em 0.5em;
      border-radius: 0 0 0 $rad-1;

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
