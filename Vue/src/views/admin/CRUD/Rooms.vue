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
          <th></th>
        </tr>
        <tr v-for="(value, key) in rooms" :key="key">
          <td>{{ value.id }}</td>
          <td>{{ value.enabled }}</td>
          <td>
            {{ value.building.details ? value.building.details.name : "" }}
          </td>
          <td>{{ value.building.campus.details.name }}</td>
          <td>{{ value.location.coordinates.latitude }}</td>
          <td>{{ value.location.coordinates.longitude }}</td>
          <td>{{ value.location.coordinates.altitude }}</td>
          <td>
            <button @click="editRoom(value.id)">Edit</button>
            <button @click="deleteRoom(value.id)">Delete</button>
            <button @click="disableRoom(value.id)">Disable</button>
          </td>
        </tr>
      </table>
      <a class="create" href="/createRoom">Create Room</a>
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

      async function editRoom(id) {
        // Navigate to edit page or open a dialog
        console.log(`Edit room with ID: ${id}`);
      }

      async function deleteRoom(id) {
        const result = await axios.delete(
          `http://localhost:8000/api/Rooms/${id}`
        );
        if (result.status === 200) {
          // Re-fetch data after delete
          await getRooms();
        }
      }

      async function disableRoom(id) {
        const result = await axios.put(`http://localhost:8000/api/Rooms/${id}`);
        if (result.status === 200) {
          // Re-fetch data after disabling
          await getRooms();
        }
      }

      getRooms();
      return { rooms, editRoom, deleteRoom, disableRoom };
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
  }
  a {
    padding: 1em;
    margin: 0.1em;
    border-radius: $rad-1;
    border-radius: $rad-1;
    background-color: $acc-1-d;
    color: $acc-1;

    &:hover {
      background-color: $acc-1;
      color: $acc-1-d;
    }
  }
</style>
