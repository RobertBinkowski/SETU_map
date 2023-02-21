<template>
  <section id="mapComponent">
    <!-- <label for="departure">Departure</label><br />
    <select name="departure">
      <option
        v-for="location in locations"
        :key="location.id"
        :value="location.id"
      >
        {{ location.id }}
      </option></select
    ><br />
    <label for="destination">Destination</label><br />
    <select name="destination">
      <option
        v-for="location in locations"
        :key="location.id"
        :value="location.id"
      >
        {{ location.id }}
      </option></select
    ><br /> -->

    <section id="canvas">
      <div
        class="location"
        :style="{ top: location.y + 'em', left: location.x + 'em' }"
        v-for="location in locations"
        :key="location.id"
      >
        <p>
          {{ location.id }}
        </p>
      </div>
    </section>
  </section>
</template>

<script>
  import { search } from "@/../js/main.js";

  export default {
    props: {
      locations: {
        required: true,
      },
      connections: {
        required: true,
      },
    },
    methods: {
      searchTheArray() {
        // alert(locations.input.focus());
        alert(search());
      },
    },
  };
</script>

<style lang="scss" scoped>
  @import "@/assets/variables.scss";
  #canvas {
    margin: auto;
    overflow: hidden;
    height: 1000px;
    width: 1000px;
    position: relative;
    background-color: rgb(56, 56, 56);
    .location {
      position: absolute;
      background-color: rgb(122, 122, 165);
      width: 2em;
      border-radius: 1em;
      height: 2em;
      p {
        padding: 0.3em 0 0 0.8em;
      }
    }
    .connection {
      display: none;
    }
  }
  #search {
    // display: none;
  }
</style>
