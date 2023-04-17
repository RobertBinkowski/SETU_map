<template>
  <main>
    <h1>Admin Page</h1>

    <div class="dashboard">
      <a v-for="table in tables" :key="table.id" :href="table">{{ table }}</a>
    </div>
  </main>
</template>

<script>
  import axios from "axios";
  import { ref } from "vue";

  export default {
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

<style lang="scss" scoped>
  @import "@/assets/variables.scss";
  .dashboard {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    padding-top: 5em;
    margin: auto;

    a {
      flex-basis: 25%;
      height: 5em;
      padding: 1em;
      margin: 1em;
      border-radius: $rad-1;
      background-color: $c-bg-1;
      text-align: center;
      display: flex;
      justify-content: center;
      align-items: center;
    }
  }
</style>
