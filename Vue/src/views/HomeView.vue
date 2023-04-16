<template>
  <main>
    <div v-if="error">{{ error.message }}</div>
    <AdminPanel :defaults="defaults" @toggle="updateNodes"></AdminPanel>
    <SearchComponent
      :rooms="rooms"
      :buildings="buildings"
      :campuses="campuses"
      @selectLocation="setLocation"
      @updateSelectedCampus="handleSelectedCampusUpdate"
    ></SearchComponent>
    <DetailsComponent
      v-show="selectedLocation && !navigation.enabled"
      :location="selectedLocation"
      @close="closeDetails"
      @openNavigation="openNavigation"
    ></DetailsComponent>
    <NavigationPanel
      v-show="navigation.enabled"
      :navigation="navigation"
      @close="closeNavigation"
      @navigate="navigate"
      @updateDisabled="updateWheelchairAccessible"
    ></NavigationPanel>
    <MapComponent
      v-show="true"
      :buildings="buildings"
      :rooms="rooms"
      :floors="floors"
      :nodes="locations"
      :campus="campuses[selectedCampus - 1]"
      :defaults="defaults"
      @selectLocation="setLocation"
    ></MapComponent>

    <!-- Still working on -->
    <CanvasComponent
      v-show="false"
      :buildings="buildings"
      :rooms="rooms"
      :floors="floors"
      :nodes="locations"
      :campus="campuses[selectedCampus - 1]"
      :defaults="defaults"
      @selectLocation="setLocation"
    ></CanvasComponent>
  </main>
</template>

<script>
  import axios from "axios";
  import { ref } from "vue";

  import { search } from "@/../js/main.js";
  import { getClosestNode } from "@/../js/functions.js";

  import MapComponent from "../components/MapComponent.vue";
  import CanvasComponent from "../components/CanvasComponent.vue";

  import SearchComponent from "../components/SearchComponent.vue";
  import DetailsComponent from "../components/DetailsComponent.vue";
  import AdminPanel from "../components/AdminPanel.vue";
  import NavigationPanel from "../components/NavigationPanel.vue";

  export default {
    components: {
      MapComponent,
      SearchComponent,
      DetailsComponent,
      AdminPanel,
      CanvasComponent,
      NavigationPanel,
    },
    setup() {
      let buildings = ref([]);
      let locations = ref([]);
      let floors = ref([]);
      let campuses = ref([]);
      let rooms = ref([]);
      let connections = ref([]);

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

      // Connections
      async function getFloors() {
        try {
          const { data } = await axios.get(
            "http://localhost:8000/api/connections"
          );
          connections.value = data;
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

      return {
        buildings,
        locations,
        campuses,
        rooms,
        floors,
        location,
        connections,
      };
    },
    data() {
      return {
        defaults: {
          onlyNodes: false,
          demo: false,
        },
        selectedLocation: null,
        selectedCampus: 1,
        navigation: {
          enabled: false,
          disabled: false,
          set: false,
          departure: null,
          destination: null,
        },
      };
    },
    methods: {
      updateNodes() {
        this.defaults.onlyNodes = !this.defaults.onlyNodes;
      },
      closeDetails() {
        this.selectedLocation = null;
      },
      closeNavigation() {
        this.navigation.enabled = false;
      },
      setLocation(location) {
        this.selectedLocation = location;
        this.locationContent = true;
      },
      handleSelectedCampusUpdate(campusId) {
        this.selectedLocation = null;
        this.selectedCampus = campusId;
      },
      updateWheelchairAccessible(isDisabled) {
        this.navigation.disabled = isDisabled;
      },
      openNavigation(location) {
        this.navigation.enabled = true;
        this.navigation.destination = location;
        this.closeDetails();
      },
      navigate() {
        this.closeNavigation();
        this.navigation.set = true;
        // if (this.navigation.departure == null) {
        //   this.navigation.departure = getClosestNode();
        // }
        let output = search(
          this.locations,
          this.connections,
          this.navigation.departure,
          this.navigation.destination,
          this.navigation.disabled
        );
        alert(JSON.stringify(this.navigation));
        return;

        if (output === null) {
          alert("Wrong information provided");
          return;
        }
        return output;
      },
    },
  };
</script>

<style lang="scss" scoped></style>
