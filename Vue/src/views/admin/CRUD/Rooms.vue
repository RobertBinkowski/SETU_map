<template>
  <main>
    <h1>Rooms</h1>
    <div class="table">
      <div class="top">
        <a v-for="table in tables" :key="table.id" :href="table">
          {{ table }}
        </a>
      </div>
      <TableComponent :data="Rooms"></TableComponent>
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
    let Rooms = ref([]);

    async function getTables() {
      const { data } = await axios.get("http://localhost:8000/api/tables");
      tables.value = data;
    }

    async function getRooms() {
      const { data } = await axios.get("http://localhost:8000/api/Rooms");
      Rooms.value = data;
    }

    getTables();
    getRooms();
    return { Rooms, tables };
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

    &:hover {
      background-color: $acc-1;
      color: $acc-1-d
    }
  }
}
</style>
