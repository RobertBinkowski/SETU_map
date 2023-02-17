<template>
  <h2>Campus</h2>
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
      <!-- <svg>
        <polyline points="20,22 1000,800 0,0"></polyline>
      </svg> -->
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
</style>
