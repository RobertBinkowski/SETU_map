<template>
  <main>
    <div v-if="error">{{ error.message }}</div>
    <AdminPanel :defaults="defaults" @toggle="updateNodes"></AdminPanel>
    <SearchComponent
      :rooms="rooms"
      :buildings="buildings"
      :campuses="campuses"
      @selectLocation="setLocation"
    ></SearchComponent>
    <DetailsComponent
      v-show="selectedLocation"
      :location="selectedLocation"
      :image="1"
      @close="closeDetails"
      @navigate="navigate"
    ></DetailsComponent>
    <MapComponent
      v-show="true"
      :buildings="buildings"
      :rooms="rooms"
      :floors="floors"
      :nodes="locations"
      :campus="campuses[0]"
      :defaults="defaults"
    ></MapComponent>
  </main>
</template>

<script>
  import axios from "axios";
  import { ref } from "vue";

  import MapComponent from "../components/MapComponent.vue";
  import CanvasComponent from "../components/CanvasComponent.vue";

  import SearchComponent from "../components/SearchComponent.vue";
  import DetailsComponent from "../components/DetailsComponent.vue";
  import AdminPanel from "../components/AdminPanel.vue";

  export default {
    components: {
      MapComponent,
      SearchComponent,
      DetailsComponent,
      AdminPanel,
      CanvasComponent,
    },
    setup() {
      let buildings = ref([]);
      let locations = ref([]);
      let floors = ref([]);
      let campuses = ref([]);
      let rooms = ref([]);

      let location = ref([]);

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

      // Floors
      async function getFloors() {
        try {
          const { data } = await axios.get("http://localhost:8000/api/floors");
          floors.value = data;
        } catch (error) {
          console.error("Error".error);
        }
      }

      // Buildings
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

      // Rooms
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

      location = {};

      function locFunction() {
        // location = newLocation;
        alert(JSON.stringify(location));
      }

      return {
        buildings,
        locations,
        campuses,
        rooms,
        floors,
        locFunction,
        location,
      };
    },
    data() {
      return {
        defaults: {
          onlyNodes: false,
          demo: false,
        },
        selectedLocation: null,
      };
    },
    methods: {
      updateNodes() {
        this.defaults.onlyNodes = !this.defaults.onlyNodes;
      },
      closeDetails() {
        this.selectedLocation = null;
      },
      setLocation(location) {
        this.selectedLocation = location;
        this.locationContent = true;
      },
      navigate(location) {
        alert(JSON.stringify(location));
      },
    },
  };
</script>

<style lang="scss" scoped></style>
