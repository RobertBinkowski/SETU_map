<template>
  <main>
    <h1>Details</h1>
    <NavigationComponent></NavigationComponent>
    <div class="table">
      <div class="top">
        <a v-for="table in tables" :key="table.id" :href="table">
          {{ table }}
        </a>
      </div>
      <table>
        <tr>
          <th>ID</th>
          <th>name</th>
          <th>abbreviation</th>
          <th>info</th>
          <th>size</th>
          <th>src</th>
          <th v-show="edit == true"></th>
        </tr>
        <tr v-for="(value, key) in details" :key="key">
          <td>{{ value.id }}</td>
          <td>{{ value.name }}</td>
          <td>{{ value.abbreviation }}</td>
          <td>{{ value.info }}</td>
          <td>{{ value.size }}</td>
          <td>{{ value.src }}</td>
          <td v-show="edit == true">
            <button :value="value.id">Edit</button>
            <button :value="value.id">Delete</button>
            <button :value="value.id">Disable</button>
          </td>
        </tr>
      </table>
      <!-- <button>Create New</button> -->
    </div>
  </main>
</template>

<script>
  import NavigationComponent from "@/components/admin/NavigationComponent.vue";

  import axios from "axios";
  import { ref } from "vue";

  export default {
    components: {
      NavigationComponent,
    },
    setup() {
      let details = ref([]);

      async function getDetails() {
        const { data } = await axios.get("http://localhost:8000/api/details");
        details.value = data;
      }

      getDetails();
      return { details };
    },
  };
</script>

<style scoped lang="scss">
  @import "@/assets/variables.scss";

  .top {
    padding: 0.1em;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;

    a {
      padding: 1em;
      margin: 0.1em;
      border-radius: $rad-1;
      border-radius: $rad-1;
      background-color: $acc-1-d;
      color: $acc-1;
    }
  }
</style>
