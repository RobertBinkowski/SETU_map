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
      :buildings="buildings"
      :rooms="rooms"
      :floors="floors"
      :nodes="locations"
      :campus="campuses[0]"
    ></MapComponent>
  </main>
</template>

<script>
  import axios from "axios";
  import { ref } from "vue";

  import MapComponent from "../components/MapComponent.vue";

  export default {
    components: {
      MapComponent,
    },
    setup() {
      let buildings = ref([]);
      let locations = ref([]);
      let floors = ref([]);
      let campuses = ref([]);
      let rooms = ref([]);

      // Campuses
      async function getCampuses() {
        const { data } = await axios.get("http://localhost:8000/api/campuses");
        campuses.value = data;
      }
      // Nodes
      async function getLocations() {
        const { data } = await axios.get("http://localhost:8000/api/locations");
        locations.value = data;
      }

      // Other
      async function getFloors() {
        const { data } = await axios.get("http://localhost:8000/api/floors");
        floors.value = data;
      }

      async function getBuildings() {
        const { data } = await axios.get("http://localhost:8000/api/buildings");
        buildings.value = data;
      }

      async function getRooms() {
        const { data } = await axios.get("http://localhost:8000/api/rooms");
        rooms.value = data;
      }

      getBuildings();
      getLocations();
      getCampuses();
      getRooms();
      getFloors();
      return {
        buildings,
        locations,
        campuses,
        rooms,
        floors,
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
