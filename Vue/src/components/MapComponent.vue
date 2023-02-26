<template>
  <section id="mapComponent">
    <LocationComponent :room="rooms[0]" v-show="false"></LocationComponent>
    <section
      id="canvas"
      :style="{ height: campus.height + 'px', width: campus.width + 'px' }"
    >
      <div
        class="location"
        v-for="location in buildings"
        :key="location.id"
        :style="{
          top: nodes[location.location_id - 1].y + 'em',
          left: nodes[location.location_id - 1].x + 'em',
          zIndex: nodes[location.location_id - 1].z + 2,
        }"
      >
        {{ location.name }}
        <div v-html="location.layout"></div>
      </div>
      <div
        class="location"
        v-for="location in rooms"
        :key="location.id"
        :style="{
          top: nodes[location.location_id - 1].y + 'em',
          left: nodes[location.location_id - 1].x + 'em',
          zIndex: nodes[location.location_id - 1].z + 1,
        }"
      >
        {{ location.info }}
        <div v-html="location.layout"></div>
      </div>
      <div
        class="location"
        v-for="location in floors"
        :key="location.id"
        :style="{
          top:
            nodes[buildings[location.building_id - 1].location_id - 1].y + 'em',
          left:
            nodes[buildings[location.building_id - 1].location_id - 1].x + 'em',
          zIndex: nodes[buildings[location.building_id - 1].location_id - 1].z,
        }"
      >
        {{ location.info }}
        <div v-html="location.layout"></div>
      </div>
    </section>
  </section>
</template>

<script>
  import { search } from "@/../js/main.js";
  import LocationComponent from "../components/LocationComponent.vue";

  export default {
    components: {
      LocationComponent,
    },
    props: {
      buildings: {
        required: true,
      },
      rooms: {
        required: true,
      },
      floors: {
        required: true,
      },
      nodes: {
        required: true,
      },
      campus: {
        required: true,
      },
    },
    methods: {
      searchTheArray() {
        // alert(nodes.input.focus());
        alert(search());
      },
    },
  };
</script>

<style lang="scss" scoped>
  @import "@/assets/variables.scss";
  #canvas {
    margin: auto;
    overflow: hidden;
    background-color: gray;
    position: relative;
    background-color: rgb(56, 56, 56);
    .location {
      position: absolute;
      // background-color: rgb(122, 122, 165);
      // width: 2em;
      // border-radius: 1em;
      // height: 2em;
      // p {
      //   padding: 0.3em 0 0 0.8em;
      // }
    }
    .connection {
      display: none;
    }
  }
  #search {
    // display: none;
  }
</style>
