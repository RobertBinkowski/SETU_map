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
      let searchData = "";
      let locations = ref([]);
      let connections = ref([]);
      let campuses = ref([]);
      let rooms = ref([]);
      // let users = ref([]);

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

      async function getRooms() {
        const { data } = await axios.get("http://localhost:8000/api/rooms");
        rooms.value = data;
      }
      // async function getUsers() {
      //   const { data } = await axios.get("http://localhost:8000/api/users");
      //   users.value = data;
      // }

      getLocations();
      getConnections();
      getCampus();
      getRooms();
      // getUsers();
      return {
        locations,
        connections,
        campuses,
        rooms,
        // users
      };
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
