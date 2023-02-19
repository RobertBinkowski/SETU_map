<template>
  <section>
    <h2>Campus</h2>
    <label for="departure">Departure</label><br />
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
    ><br />

    <input type="submit" v-on:click="searchTheArray()" value="search" />

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
  import axios from "axios";
  import { ref } from "vue";
  import { search } from "../../../js/main.js";

  export default {
    setup() {
      let searchData = "";
      let locations = ref([]);
      let connections = ref([]);

      async function getLocations() {
        const { data } = await axios.get("http://localhost:8000/api/locations");
        locations.value = data;
      }
      async function getConnections() {
        const { data } = await axios.get(
          "http://localhost:8000/api/connections"
        );
        connections.value = data;
      }

      getLocations();
      getConnections();
      // console.log(locations.focus());

      return { locations, connections };
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
