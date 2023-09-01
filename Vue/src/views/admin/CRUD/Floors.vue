<template>
  <main>
    <h1>Floors</h1>
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
          <th>Enabled</th>
          <th>Floor</th>
          <th>Name</th>
          <th>Abbreviation</th>
          <th>Info</th>
          <th>Size</th>
          <th>Image</th>
          <th>Building</th>
          <th v-show="edit == true"></th>
        </tr>
        <tr v-for="(value, key) in  floors " :key="key">
          <td>{{ value.id }}</td>
          <td>{{ value.enabled }}</td>
          <td>{{ value.floor }}</td>
          <td>{{ value.details ? value.details.name : '' }}</td>
          <td>{{ value.details ? value.details.abbreviation : '' }}</td>
          <td>{{ value.details ? value.details.info : '' }}</td>
          <td>{{ value.details ? value.details.size : '' }}</td>
          <td>{{ value.details ? value.details.src : '' }}</td>
          <td>{{ value.building ? value.building : '' }}</td>
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
    NavigationComponent
  },
  setup() {
    let floors = ref([]);

    async function getFloors() {
      const { data } = await axios.get("http://localhost:8000/api/Floors");
      floors.value = data;
    }

    getFloors();
    return { floors };
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
