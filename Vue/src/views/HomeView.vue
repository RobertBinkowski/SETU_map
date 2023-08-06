<template>
  <main>
    <div v-if="error">{{ error.message }}</div>
    <SearchComponent
      v-if="rooms && buildings && campuses"
      :rooms="rooms"
      :buildings="buildings"
      :campuses="campuses"
      @selectLocation="setLocation"
      @updateSelectedCampus="handleSelectedCampusUpdate"
    ></SearchComponent>
    <DetailsComponent
      v-if="selectedLocation && !navigation.enabled"
      :location="selectedLocation"
      @close="closeDetails"
      @openNavigation="openNavigation"
      @setDeparture="setDepartureLoc"
    ></DetailsComponent>
    <NavigationPanel
      v-if="navigation.enabled"
      :navigation="navigation"
      @close="closeNavigation"
      @navigate="navigate"
      @updateDisabled="updateWheelchairAccessible"
    ></NavigationPanel>

    <MapParentComponent
      v-if="locations"
      :locations="locations"
      :campus="campuses[selectedCampus - 1]"
    ></MapParentComponent>
  </main>
</template>

<script>
  import axios from "axios";
  import { ref } from "vue";

  import { search } from "@/../js/main.js";
  import { getClosestNode } from "@/../js/functions.js";

  import MapParentComponent from "../components/map/MapParentComponent.vue";

  import SearchComponent from "../components/search/SearchComponent.vue";
  import DetailsComponent from "../components/search/DetailsComponent.vue";
  import NavigationPanel from "../components/NavigationPanel.vue";

  export default {
    components: {
      SearchComponent,
      DetailsComponent,
      NavigationPanel,
      MapParentComponent,
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
          demo: true,
        },
        selectedLocation: null,
        selectedCampus: 1,
        navigation: {
          enabled: false,
          disabled: false,
          departure: null,
          destination: null,
          distance: null,
          nodeIds: [],
          path: [],
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
      setDepartureLoc(location) {
        this.navigation.departure = location;
        this.selectedLocation = null;
      },
      setDeparture(x = 0, y = 0, z = 0) {
        if (this.navigation.set == false) {
          this.navigation.departure = getClosestNode(this.locations, x, y, z);
        }
      },
      navigate() {
        if (this.navigation.departure == null) {
          this.navigation.departure = getClosestNode(this.locations);
        }

        let output = search(
          this.locations,
          this.connections,
          this.navigation.departure,
          this.navigation.destination.location,
          this.navigation.disabled
        );
        if (output === []) {
          alert("No Route found");
          return;
        }

        [
          this.navigation.distance,
          this.navigation.nodeIds,
          this.navigation.path,
        ] = output;

        alert(this.navigation.nodeIds);
      },
    },
  };
</script>

<style lang="scss" scoped></style>
