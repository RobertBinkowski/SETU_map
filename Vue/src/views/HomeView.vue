<template>
  <main>
    <SearchComponent
      v-if="campuses"
      :rooms="rooms"
      :buildings="buildings"
      :campuses="campuses"
      @selectLocation="toggleNavigationPanel"
      @updateSelectedCampus="handleSelectedCampusUpdate"
    ></SearchComponent>
    <NavigationPanel
      v-if="navigationPanelOpen"
      :location="location"
      :locations="locations"
      :connections="connections"
      :entrance="campus.entrance"
      @updatePath="handleUpdatePath"
      @close="toggleNavigationPanel"
    ></NavigationPanel>
    <MapParentComponent
      v-if="locations"
      :locations="rooms"
      :campus="this.campus"
      :path="path"
      @selectLocation="toggleNavigationPanel"
    ></MapParentComponent>
  </main>
</template>

<script>
  import axios from "axios";
  import { ref } from "vue";

  // Components
  import MapParentComponent from "../components/map/MapParentComponent.vue";
  import SearchComponent from "../components/search/SearchComponent.vue";
  import NavigationPanel from "../components/navigation/NavigationPanel.vue";

  export default {
    components: {
      SearchComponent,
      NavigationPanel,
      MapParentComponent,
    },
    setup() {
      let campuses = ref([]);
      let buildings = ref([]);
      let locations = ref([]);
      let rooms = ref([]);
      let connections = ref([]);

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

      // Locations
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

      // Connections
      async function getConnections() {
        try {
          const { data } = await axios.get(
            "http://localhost:8000/api/connections"
          );
          connections.value = data;
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
      getConnections();

      return {
        buildings,
        locations,
        campuses,
        rooms,
        connections,
      };
    },
    data() {
      return {
        navigationPanelOpen: false,
        campus: null,
        location: null,
        path: null, // [path, nodeIds]
      };
    },
    methods: {
      toggleNavigationPanel(loc = null) {
        if (loc === this.location) {
          this.navigationPanelOpen = false;
          this.location = null;
        } else if (loc == null) {
          this.navigationPanelOpen = false;
          this.location = null;
        } else {
          this.navigationPanelOpen = true;
          this.location = loc;
        }
      },

      handleUpdatePath(newPath) {
        this.path = newPath; // [path, nodeIds]
      },

      handleSelectedCampusUpdate(campus) {
        this.selectedLocation = null;
        this.toggleNavigationPanel();
        this.campus = campus;
      },
    },
  };
</script>
