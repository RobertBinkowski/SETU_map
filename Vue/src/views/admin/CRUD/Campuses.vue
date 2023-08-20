<template>
  <main>
    <h1>Campuses</h1>
    <div class="table">
      <div class="top">
        <a v-for="table in tables" :key="table.id" :href="table">
          {{ table }}
        </a>
      </div>
      <TableComponent :data="campuses"></TableComponent>
      <!-- <button>Create New</button> -->
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
    let tables = ref([]);
    let campuses = ref([]);

    async function getTables() {
      const { data } = await axios.get("http://localhost:8000/api/tables");
      tables.value = data;
    }

    async function getcampuses() {
      const { data } = await axios.get("http://localhost:8000/api/campuses");
      campuses.value = data;
    }

    getTables();
    getcampuses();
    return { campuses, tables };
  },
};
</script>

<style scoped lang="scss">
@import "@/assets/variables.scss";

.top {
  padding: .1em;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;

  a {
    padding: 1em;
    margin: .1em;
    border-radius: $rad-1;
    border-radius: $rad-1;
    background-color: $acc-1-d;
    color: $acc-1;
  }
}
</style>
