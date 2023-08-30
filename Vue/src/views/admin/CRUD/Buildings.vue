<template>
  <main>
    <h1>Buildings</h1>
    <div class="table">
      <NavigationComponent></NavigationComponent>
      <table>
        <tr>
          <th>ID</th>
          <th>Enabled</th>
          <th>Name</th>
          <th>Abbreviation</th>
          <th>Info</th>
          <th>Size</th>
          <th>Image</th>
          <th>Campus</th>
          <th>Latitude</th>
          <th>Longitude</th>
          <th>Altitude</th>
          <th v-show="edit == true"></th>
        </tr>
        <tr v-for="(value, key) in  buildings " :key="key">
          <td>{{ value.id }}</td>
          <td>{{ value.enabled }}</td>
          <td>
            {{ value.details ? value.details.name : '' }} </td>
          <td>{{ value.details ? value.details.abbreviation : '' }} </td>
          <td>{{ value.details ? value.details.info : '' }} </td>
          <td>{{ value.details ? value.details.size : '' }} </td>
          <td>{{ value.details ? value.details.src : '' }} </td>
          <td>{{ value.campus.details.name }}</td>
          <td>
            {{ value.location.coordinates ? value.location.coordinates.latitude : 0 }} </td>
          <td>{{ value.location.coordinates ? value.location.coordinates.longitude : 0 }}</td>
          <td> {{ value.location.coordinates ? value.location.coordinates.altitude : 0 }}
          </td>
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
import NavigationComponent from "../../../components/admin/NavigationComponent.vue";
import axios from "axios";
import { ref } from "vue";

export default {
  components: {
    NavigationComponent
  },
  setup() {
    let buildings = ref([]);

    async function getBuildings() {
      const { data } = await axios.get("http://localhost:8000/api/buildings");
      buildings.value = data;
    }

    getBuildings();
    return { buildings };
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
