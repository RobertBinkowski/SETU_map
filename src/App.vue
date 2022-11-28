<script setup>
  import { RouterLink, RouterView } from "vue-router";
  import BottomFooter from "./components/BottomFooter.vue";
  import TopNav from "./components/TopNav.vue";
  import AlertBox from "./components/AlertBox.vue";
</script>

<template>
  <div class="app">
    <TopNav></TopNav>
    <AlertBox :alerts="alert - warning"></AlertBox>
    <div class="content">
      <RouterView></RouterView>
    </div>
    <BottomFooter></BottomFooter>
  </div>
</template>

<style lang="scss" scoped>
  .app {
    overflow: hidden;
    padding: 0;
    margin: 0;
    .content {
      margin: auto;
      max-width: 1500px;
    }
  }
</style>
