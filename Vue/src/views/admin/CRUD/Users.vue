<template>
  <main>
    <h1>Users</h1>
    <div class="table">
      <div>
        <button
          v-for="table in tables"
          :key="table.id"
          @click="setData()"
          v-show="table.Tables_in_setu_map != 'logs'"
        >
          {{ table.Tables_in_setu_map }}
        </button>
      </div>
      <TableComponent :data="users"></TableComponent>
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
      let users = ref([]);

      async function getTables() {
        const { data } = await axios.get("http://localhost:8000/api/tables");
        tables.value = data;
      }

      async function getUsers() {
        const { data } = await axios.get("http://localhost:8000/api/users");
        users.value = data;
      }

      getTables();
      getUsers();
      return { users, tables };
    },
    methods: {
      setData: function () {
        // Not Working
        // data.value = locations;
        // alert(data.value);
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
