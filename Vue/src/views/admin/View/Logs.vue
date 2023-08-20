<template>
  <main>
    <h1>Logs</h1>
    <div class="top">
      <a v-for="table in tables" :key="table.id" :href="table">
        {{ table }}
      </a>
    </div>
    <div class="table">
      <TableComponent :data="logs" :edit="false"></TableComponent>
    </div>
  </main>
</template>

<script>
import TableComponent from "@/components/admin/TableComponent.vue";
import axios from "axios";
import { ref } from "vue";

export default {
  components: {
    TableComponent,
  },
  setup() {
    let logs = ref([]);
    let tables = ref([]);

    async function getTables() {
      const { data } = await axios.get("http://localhost:8000/api/tables");
      tables.value = data;
    }
    async function getLogs() {
      const { data } = await axios.get("http://localhost:8000/api/logs");
      logs.value = data;
    }

    getLogs();
    getTables();
    return { logs, tables };
  },
};
</script>

<style scoped lang="scss">
@import "@/assets/variables.scss";
</style>
