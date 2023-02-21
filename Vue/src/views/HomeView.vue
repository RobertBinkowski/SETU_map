<template>
  <main>
    <h2 id="campus">
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
    <MapComponent
      :locations="locations"
      :connections="connections"
    ></MapComponent>
    <LocationComponent :locations="locations"></LocationComponent>
  </main>
</template>

<script>
  // import { escapeHtmlComment } from "@vue/shared";

  import axios from "axios";
  import { ref } from "vue";

  import MapComponent from "../components/MapComponent.vue";
  import LocationComponent from "../components/LocationComponent.vue";

  export default {
    components: {
      MapComponent,
      LocationComponent,
      // escapeHtmlComment,
    },
    setup() {
      let searchData = "";
      let locations = ref([]);
      let connections = ref([]);
      let campuses = ref([]);

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
      async function getCampus() {
        const { data } = await axios.get("http://localhost:8000/api/campus");
        campuses.value = data;
      }

      getLocations();
      getConnections();
      getCampus();

      return { locations, connections, campuses };
    },
  };
</script>

<style lang="scss" scoped>
  @import "@/assets/variables.scss";
  #campus {
    select {
      width: 100%;
      text-align: center;
      padding: 0.3em;
      background-color: #ffffff00;
      color: $txt-1;
      border: none;
      outline: none;
    }
  }
</style>
