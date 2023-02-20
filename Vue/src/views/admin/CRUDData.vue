<template>
  <main>
    <h1>Data From The Database</h1>
    <div>
      <button v-for="table in tables" :key="table.id">
        {{ table.Tables_in_setu_map }}
      </button>
    </div>
    <DisplayData :data="locations"></DisplayData>
  </main>
</template>

<script>
  import DisplayData from "./data/displayData.vue";
  import axios from "axios";
  import { ref } from "vue";

  export default {
    components: {
      DisplayData,
    },
    setup() {
      let tables = ref([]);
      let locations = ref([]);

      async function getTables() {
        const { data } = await axios.get("http://localhost:8000/api/tables");
        tables.value = data;
      }

      async function getLocations() {
        const { data } = await axios.get("http://localhost:8000/api/locations");
        locations.value = data;
      }
      getTables();
      getLocations();
      return { locations, tables };
    },
  };
</script>
