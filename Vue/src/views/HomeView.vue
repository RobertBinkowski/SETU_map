<template>
  <main>
    <div v-if="error">{{ error.message }}</div>
    <div class="campusSelect">
      <h2>
        <!-- Campus: -->
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
    <SearchComponent :data="rooms"></SearchComponent>
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
  import SearchComponent from "../components/SearchComponent.vue";

  export default {
    components: {
      MapComponent,
      SearchComponent,
    },
    setup() {
      let buildings = ref([]);
      let locations = ref([]);
      let floors = ref([]);
      let campuses = ref([]);
      let rooms = ref([]);

      // Campuses
      async function getCampuses() {
        try {
          const { data } = await axios.get(
            "http://localhost:8000/api/campuses"
          );
          campuses.value = data;
        } catch (error) {
          console.error("Error".error);
        }
      }

      // Nodes
      async function getLocations() {
        try {
          const { data } = await axios.get(
            "http://localhost:8000/api/locations"
          );
          locations.value = data;
        } catch (error) {
          console.error("Error".error);
        }
      }

      // Other
      async function getFloors() {
        try {
          const { data } = await axios.get("http://localhost:8000/api/floors");
          floors.value = data;
        } catch (error) {
          console.error("Error".error);
        }
      }

      async function getBuildings() {
        try {
          const { data } = await axios.get(
            "http://localhost:8000/api/buildings"
          );
          buildings.value = data;
        } catch (error) {
          console.error("Error".error);
        }
      }

      async function getRooms() {
        try {
          const { data } = await axios.get("http://localhost:8000/api/rooms");
          rooms.value = data;
        } catch (error) {
          console.error("Error".error);
        }
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
