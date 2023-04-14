<template>
  <main>
    <div v-if="error">{{ error.message }}</div>
    <AdminPanel :defaults="defaults" @toggle="updateNodes"></AdminPanel>
    <SearchComponent
      :locations="rooms"
      :campuses="campuses"
      @toggle="toggleDetails"
    ></SearchComponent>
    <DetailsComponent
      v-show="locationContent"
      :location="rooms[intValue]"
      :image="1"
      @close="toggleDetails"
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
    <!-- <CanvasComponent
      v-show="false"
      :buildings="buildings"
      :rooms="rooms"
      :floors="floors"
      :nodes="locations"
      :campus="campuses[0]"
      :defaults="defaults"
    >
    </CanvasComponent> -->
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
    data() {
      return {
        defaults: {
          onlyNodes: false,
          demo: false,
        },
        intValue: 0,
        locationContent: true,
      };
    },
    methods: {
      updateNodes() {
        this.defaults.onlyNodes = !this.defaults.onlyNodes;
      },
      toggleDetails() {
        this.locationContent = !this.locationContent;
      },
      showDetails(location) {
        this.locationContent = true;
      },
      navigate(location) {
        alert(JSON.stringify(location));
      },
    },
  };
</script>

<style lang="scss" scoped></style>
