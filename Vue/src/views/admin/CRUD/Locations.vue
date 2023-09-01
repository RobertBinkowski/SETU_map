<template>
  <main>
    <h1>Locations</h1>
    <div class="table">
      <NavigationComponent></NavigationComponent>
      <table>
        <tr>
          <th>ID</th>
          <th>Enabled</th>
          <th>Type</th>
          <th>Latitude</th>
          <th>Longitude</th>
          <th>Altitude</th>
          <th v-show="edit == true"></th>
        </tr>
        <tr v-for="(value, key) in  locations " :key="key">
          <td>{{ value.id }}</td>
          <td>{{ value.enabled }}</td>
          <td>{{ value.type }}</td>
          <td>{{ value.coordinates.latitude }}</td>
          <td>{{ value.coordinates.longitude }}</td>
          <td>{{ value.coordinates.altitude }}</td>
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
    let locations = ref([]);

    async function getLocations() {
      const { data } = await axios.get("http://localhost:8000/api/locations");
      locations.value = data;
    }

    getLocations();
    return { locations };
  },
  methods: {
    setData: function () {
      data.value = locations;
      alert(data.value);
    },
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
