<template>
  <section>{{ data }}</section>
</template>

<script>
  import axios from "axios";

  export default {
    name: "App",
    setup() {
      async function getData() {
        const { data } = await axios.get("http://localhost:8000/user");
        return data;
      }
      const data = getData();
      return { data };
    },
  };
</script>
