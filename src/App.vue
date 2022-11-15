<script setup>
  import { RouterLink, RouterView } from "vue-router";
  import HelloWorld from "./components/HelloWorld.vue";
  import BottomFooter from "./components/BottomFooter.vue";
  import TopNav from "./components/TopNav.vue";
</script>

<template>
  <div>
    <TopNav></TopNav>
    <RouterView></RouterView>
    <BottomFooter></BottomFooter>
  </div>
</template>

<style scoped></style>
