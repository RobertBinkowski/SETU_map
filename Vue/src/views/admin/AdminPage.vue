<template>
  <main>
    <h1>Admin Page</h1>
    <NavigationComponent></NavigationComponent>
    <div class="dashboard">
      <div>
        <a href="searches">Searches</a>
      </div>
      <div>
        <a href="logs">Logs</a>
      </div>
    </div>
  </main>
</template>

<script>
  import NavigationComponent from "../../components/admin/NavigationComponent.vue";
  export default {
    components: {
      NavigationComponent,
    },
    data() {
      return {
        user: localStorage.getItem("user"),
      };
    },
  };
</script>

<style lang="scss" scoped>
  @import "@/assets/variables.scss";

  .dashboard {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    padding-top: 5em;
    margin: auto;

    div {
      flex-basis: 25%;
      height: 5em;
      padding: 1em;
      margin: 1em;
      border-radius: $rad-1;
      background-color: $acc-1-d;
      color: $acc-1;
      text-align: center;
      display: flex;
      justify-content: center;
      align-items: center;
    }
  }
</style>
