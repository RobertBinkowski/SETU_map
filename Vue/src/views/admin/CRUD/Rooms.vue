<template>
  <main>
    <h1>Rooms</h1>
    <div class="table">
      <NavigationComponent></NavigationComponent>
      <table>
        <tr>
          <th>ID</th>
          <th>Enabled</th>
          <th>Building</th>
          <th>Campus</th>
          <th>Latitude</th>
          <th>Longitude</th>
          <th>Altitude</th>
          <th v-show="edit == true"></th>
        </tr>
        <tr v-for="(value, key) in  rooms " :key="key">
          <td>{{ value.id }}</td>
          <td>{{ value.enabled }}</td>
          <td>{{ value.building.details ? value.building.details.name : "" }}</td>
          <td>{{ value.building.campus.details.name }}</td>
          <td>{{ value.location.coordinates.latitude }}</td>
          <td>{{ value.location.coordinates.longitude }}</td>
          <td>{{ value.location.coordinates.altitude }}</td>
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
    let rooms = ref([]);


    async function getRooms() {
      const { data } = await axios.get("http://localhost:8000/api/Rooms");
      rooms.value = data;
    }

    getRooms();
    return { rooms };
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
