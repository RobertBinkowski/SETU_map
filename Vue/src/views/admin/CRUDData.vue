<template>
  <main>
    <h1>Data From The Database</h1>
    <div class="table">
      <div>
        <button v-for="table in tables" :key="table.id" @click="setData()">
          {{ table.Tables_in_setu_map }}
        </button>
      </div>
      <DisplayData :data="data"></DisplayData>
      <button>Create New</button>
    </div>
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
      let data = ref([]);

      let locations = ref([]);

      async function getTables() {
        const { data } = await axios.get("http://localhost:8000/api/tables");
        tables.value = data;
      }

      async function getData() {
        const { data } = await axios.get("http://localhost:8000/api/locations");
        locations.value = data;
      }

      getTables();
      getData();
      return { data, tables };
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
