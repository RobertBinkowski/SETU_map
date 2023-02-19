<template>
  <main>
    <h1>Data From The Database</h1>

    <DisplayData :data="output"></DisplayData>
  </main>
</template>

<script>
  import DisplayData from "./data/displayData.vue";
  import axios from "axios";
  import { ref } from "vue";

  export default {
    components: {
      DisplayData,
    },
    setup() {
      let output = ref([]);

      async function getLocations() {
        const { data } = await axios.get("http://localhost:8000/api/locations");
        output.value = data;
      }

      getLocations();
      return { output };
    },
  };
</script>
