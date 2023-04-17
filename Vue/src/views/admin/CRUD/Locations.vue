<template>
  <main>
    <h1>Locations</h1>
    <div class="table">
      <div class="top">
        <a v-for="table in tables" :key="table.id" :href="table">
          {{ table }}
        </a>
      </div>
      <TableComponent :data="locations"></TableComponent>
      <!-- <button>Create New</button> -->
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
  .top {
    padding: 2em;
    a {
      padding: 1em;
      margin: 1em;
      border-radius: $rad-1;
      background-color: $c-bg-1;
    }
  }
</style>
