<template>
  <main>
    <h1>Logs</h1>
    <div class="table">
      <TableComponent :data="logs" :edit="false"></TableComponent>
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
      let logs = ref([]);

      async function getLogs() {
        const { data } = await axios.get("http://localhost:8000/api/logs");
        logs.value = data;
      }

      getLogs();
      return { logs };
    },
  };
</script>

<style scoped lang="scss">
  @import "@/assets/variables.scss";
</style>
