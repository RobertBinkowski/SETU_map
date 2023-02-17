<template>
  <h2>Map2</h2>
  <section v-for="entry in entries" :key="entry.id">
    <p>
      {{ entry }}
    </p>
  </section>
</template>

<script>
  import axios from "axios";
  import { ref } from "vue";

  export default {
    name: "App",
    setup() {
      let entries = ref([]);
      async function getData() {
        const { data } = await axios.get("http://localhost:8000/user");
        console.log(data);
        entries.value = data;
      }
      getData();
      return { entries };
    },
  };
</script>
