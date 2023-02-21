<template>
  <main>
    <h1>Locations</h1>
    <div class="table">
      <div>
        <button v-for="table in tables" :key="table.id" @click="setData()">
          {{ table.Tables_in_setu_map }}
        </button>
      </div>
      <TableComponent :data="locations"></TableComponent>
      <button>Create New</button>
    </div>
  </main>
</template>

<script>
  import TableComponent from "@/components/TableComponent.vue";
  import axios from "axios";
  import { ref } from "vue";

  export default {
    components: {
      TableComponent,
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
    methods: {
      setData: function () {
        data.value = locations;
        alert(data.value);
      },
    },
  };
</script>

<style scoped lang="scss">
  @import "@/assets/variables.scss";
  .table {
    // padding: 1em;
  }
</style>
