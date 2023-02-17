<template>
  <h2>Campus</h2>
  <form action="" id="search">
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
    <input type="submit" value="search" />
  </form>
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

    <div
      class="connection"
      v-for="connection in connections"
      :key="connection.id"
    >
      <p>
        {{ connection }}
      </p>
    </div>
  </section>
</template>

<script>
  import axios from "axios";
  import { ref } from "vue";
  // import { search } from "../../../js/main.js";

  export default {
    name: "App",
    setup() {
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
      console.log(typeof connections.value);
      // search(locations, connections);

      return { locations, connections };
    },
    computed: {},
  };
</script>

<style lang="scss" scoped>
  #canvas {
    margin: auto;
    overflow: hidden;
    height: 1000px;
    width: 1000px;
    position: relative;
    .location {
      position: absolute;
      background-color: blue;
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
    display: none;
  }
</style>
