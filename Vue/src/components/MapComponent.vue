<template>
  <section id="mapComponent">
    <LocationComponent
      :room="rooms[0]"
      v-show="locationContent"
    ></LocationComponent>
    <div v-show="demo" id="demo">
      <h2>Admin Panel</h2>
      <input type="checkbox" name="showOnlyNodes" @click="toggleNodes" />
      <label for="showOnlyNodes">Only Nodes & Connections</label>
    </div>
    <section
      id="canvas"
      :style="{ height: campus.height + 'px', width: campus.width + 'px' }"
    >
      <div
        v-show="!onlyNodes"
        class="location"
        v-for="building in buildings"
        :key="building.id"
        :style="{
          top: building.location.mapLatitude + 'em',
          left: building.location.mapLongitude + 'em',
          zIndex: building.location.mapAltitude + 100,
        }"
      >
        {{ building.name }}
        <div v-html="building.layout"></div>
      </div>
      <div
        v-show="!onlyNodes"
        class="location"
        v-for="room in rooms"
        :key="room.id"
        :style="{
          top: room.location.mapLatitude + 'em',
          left: room.location.mapLongitude + 'em',
          zIndex: room.location.mapAltitude + 10,
        }"
      >
        {{ room.location.mapLongitude }}
        <div v-html="room.layout"></div>
      </div>
      <div
        v-show="!onlyNodes"
        class="location"
        v-for="floor in floors"
        :key="floor.id"
        :style="{
          top: floor.building.location.mapLatitude + 'em',
          left: floor.building.location.mapLongitude + 'em',
          zIndex: floor.building.location.mapAltitude,
        }"
      >
        <div v-html="floor.layout"></div>
      </div>
      <div
        v-show="onlyNodes"
        class="node"
        v-for="node in nodes"
        :key="node.id"
        :style="{
          top: node.mapLatitude + 'em',
          left: node.mapLongitude + 'em',
          zIndex: node.mapAltitude,
        }"
      >
        {{ node.id }}
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
      toggleNodes() {
        if (this.onlyNodes == true) {
          this.onlyNodes = false;
        } else {
          this.onlyNodes = true;
        }
      },
    },
    data() {
      return {
        locationContent: false,
        onlyNodes: false,
        demo: true,
      };
    },
  };
</script>

<style lang="scss" scoped>
  @import "@/assets/variables.scss";
  #canvas {
    margin: auto;
    overflow: scroll;
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
    .node {
      background-color: rgb(122, 122, 165);
      width: 2em;
      border-radius: 1em;
      padding: 0.2em 0.7em;
      height: 2em;
    }
  }
  #demo {
    position: fixed;
    z-index: 100;
    padding: 1em;
    right: 2em;
    top: 3em;
    background: gray;
    color: $acc-1;
    font-size: 1.2em;
    input[type="checkbox"] {
      height: 1em;
      width: 1em;
      margin: 1em;
    }
  }
</style>
