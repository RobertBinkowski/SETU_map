<template>
  <main>
    <h1>Rooms</h1>
    <NavigationComponent></NavigationComponent>
    <div class="table">
      <div class="createDiv">
        <label>
          Type: <br />
          <select v-model="newRoom.type">
            <option value="room">room</option>
            <option value="toilet">toilet</option>
            <option value="office">office</option>
          </select> </label
        ><br />

        <label>
          Building: <br />
          <select class="styled-input" v-model="newRoom.building.id">
            <option
              v-for="building in buildings"
              :key="building.id"
              :value="building.id"
            >
              {{ building.id }} - {{ building.details.name }}
            </option>
          </select> </label
        ><br />

        <label>
          Location: <br />
          <select class="styled-input" v-model="newRoom.location.id">
            <option
              v-for="location in locations"
              :key="location.id"
              :value="location.id"
            >
              {{ location.id }} - {{ location.type }}
            </option>
          </select> </label
        ><br />

        <label>
          Floor: <br />
          <select class="styled-input" v-model="newRoom.location.id">
            <option v-for="floor in floors" :key="floor.id" :value="floor.id">
              {{ floor.floor }}
            </option>
          </select> </label
        ><br />

        <label>
          Details: <br />
          <select class="styled-input" v-model="newRoom.location.id">
            <option
              v-for="details in details"
              :key="details.id"
              :value="details.id"
            >
              {{ details.id }} - {{ details.name }}
            </option>
          </select> </label
        ><br />

        <label>
          Enabled: <br />
          <input type="checkbox" v-model="newRoom.enabled" /> </label
        ><br />

        <button class="create-button" @click="createRoom">Create</button>
      </div>
    </div>
  </main>
</template>

<script>
  import NavigationComponent from "@/components/admin/NavigationComponent.vue";
  import axios from "axios";
  import { ref, onMounted } from "vue";

  export default {
    components: {
      NavigationComponent,
    },
    setup() {
      let newRoom = ref({
        type: "",
        enabled: false,
        building: {
          id: "",
        },
        location: {
          id: "",
        },
        floor: {
          id: "",
        },
        details: {
          id: "",
        },
      });

      let floors = ref([]);
      let buildings = ref([]);
      let locations = ref([]);
      let details = ref([]);

      const fetchData = async (url) => {
        const { data } = await axios.get(url);
        return data;
      };

      onMounted(async () => {
        floors.value = await fetchData("http://localhost:8000/api/floors");
        buildings.value = await fetchData(
          "http://localhost:8000/api/buildings"
        );
        locations.value = await fetchData(
          "http://localhost:8000/api/locations"
        );
        details.value = await fetchData("http://localhost:8000/api/details");
      });

      async function createRoom() {
        const result = await axios.post(
          "http://localhost:8000/api/Rooms",
          newRoom.value
        );
        if (result.status === 201) {
          // Reset form
          newRoom.value = {
            type: "",
            enabled: false,
            building: {
              id: "",
            },
            location: {
              id: "",
            },
            floor: {
              id: "",
            },
            details: {
              id: "",
            },
          };
        }
      }

      return {
        newRoom,
        createRoom,
        floors,
        buildings,
        locations,
        details,
      };
    },
  };
</script>

<style lang="scss" scoped>
  .createDiv {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
    background-color: #f0f0f0;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }
  .styled-input,
  select {
    width: 80%;
    padding: 10px;
    margin: 5px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 1em;
    min-width: 20em;
  }
  .create-button {
    padding: 10px 20px;
    margin-top: 10px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;

    &:hover {
      background-color: #0056b3;
    }
  }
</style>
