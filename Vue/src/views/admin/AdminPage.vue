<template>
  <main>
    <h1>Admin Page</h1>

    <div>
      <a v-for="table in tables" :key="table.id" href=""></a>
    </div>
  </main>
</template>

<script>
  import axios from "axios";
  import { ref } from "vue";

  export default {
    components: {
      TableComponent,
    },
    setup() {
      let tables = ref([]);

      async function getTables() {
        const { data } = await axios.get("http://localhost:8000/api/tables");
        tables.value = data;
      }

      getTables();
      return { tables };
    },
  };
</script>

<style lang="sass" scoped></style>
