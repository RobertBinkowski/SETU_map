<template>
  <main>
    <h1>Images</h1>
    <div class="table">
      <div class="top">
        <a v-for="table in tables" :key="table.id" :href="table">
          {{ table }}
        </a>
      </div>
      <TableComponent :data="Images"></TableComponent>
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
      let Images = ref([]);

      async function getTables() {
        const { data } = await axios.get("http://localhost:8000/api/tables");
        tables.value = data;
      }

      async function getImages() {
        const { data } = await axios.get("http://localhost:8000/api/Images");
        Images.value = data;
      }

      getTables();
      getImages();
      return { Images, tables };
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
