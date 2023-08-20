<template>
  <main>
    <h1>Buildings</h1>
    <div class="table">
      <NavigationComponent></NavigationComponent>
      <TableComponent :data="buildings"></TableComponent>
      <!-- <button>Create New</button> -->
    </div>
  </main>
</template>

<script>
import TableComponent from "@/components/admin/TableComponent.vue";
import NavigationComponent from "../../../components/admin/NavigationComponent.vue";
import axios from "axios";
import { ref } from "vue";

export default {
  components: {
    TableComponent,
    NavigationComponent
  },
  setup() {
    // let tables = ref([]);
    let buildings = ref([]);

    // Old system to get all tables
    // async function getTables() {
    //   const { data } = await axios.get("http://localhost:8000/api/tables");
    //   tables.value = data;
    // }

    async function getBuildings() {
      const { data } = await axios.get("http://localhost:8000/api/buildings");
      buildings.value = data;
    }

    // getTables();
    getBuildings();
    return { buildings };
    // return { buildings, tables };
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
