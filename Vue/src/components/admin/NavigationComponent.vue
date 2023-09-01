<template>
  <div class="admin-nav-component">
    <a v-for="table in tables" :key="table.id" :href="table.src">
      {{ table.name }}
    </a>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        tables: [
          { name: "Dashboard", src: "Admin" },
          { name: "Buildings", src: "buildings" },
          { name: "Campuses", src: "campuses" },
          { name: "Connections", src: "connections" },
          { name: "Locations", src: "locations" },
          { name: "Details", src: "details" },
          { name: "Floors", src: "floors" },
          { name: "Rooms", src: "rooms" },
        ],
      };
    },
  };
</script>

<style scoped lang="scss">
  @import "@/assets/variables.scss";

  .admin-nav-component {
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
