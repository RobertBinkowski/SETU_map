<template>
  <main>
    <div class="campusSelect">
      <h2>
        Campus:
        <select name="campus">
          <option
            v-for="campus in campuses"
            :key="campus"
            :value="campus.abbreviation"
          >
            {{ campus.name }}
          </option>
        </select>
      </h2>
    </div>
    <MapComponent
      :locations="locations"
      :connections="connections"
      :rooms="rooms"
      :campus="campuses[0]"
    ></MapComponent>
  </main>
</template>

<script>
  // import { escapeHtmlComment } from "@vue/shared";

  import axios from "axios";
  import { ref } from "vue";

  import MapComponent from "../components/MapComponent.vue";

  export default {
    components: {
      MapComponent,
      // escapeHtmlComment,
    },
    setup() {
      let locations = ref([]);
      let connections = ref([]);
      let campuses = ref([]);
      let rooms = ref([]);

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
      async function getCampuses() {
        const { data } = await axios.get("http://localhost:8000/api/campuses");
        campuses.value = data;
      }

      async function getRooms() {
        const { data } = await axios.get("http://localhost:8000/api/rooms");
        rooms.value = data;
      }

      getLocations();
      getConnections();
      getCampuses();
      getRooms();
      return {
        locations,
        connections,
        campuses,
        rooms,
      };
    },
  };
</script>

<style lang="scss" scoped>
  @import "@/assets/variables.scss";
  .campusSelect {
    width: 100%;
    padding: 0.3em;
    background-color: #ffffff00;
    color: $txt-1;
    text-align: center;

    select {
      border: none;
      border-radius: 1em;
      width: 10em;
      text-align: center;
      outline: none;
    }
  }
</style>
