<template>
  <section id="mapComponent">
    <section
      id="canvas"
      :style="{ height: campus.height + 'px', width: campus.width + 'px' }"
    >
      <div
        v-show="!defaults.onlyNodes"
        class="location"
        v-for="building in buildings"
        :key="building.id"
        @click="emitLocation(building)"
        :style="{
          top: building.location.mapLatitude + 'px',
          left: building.location.mapLongitude + 'px',
          zIndex: building.location.mapAltitude + 100,
        }"
      >
        {{ building.name }}
        <div v-html="building.layout"></div>
      </div>
      <div
        v-show="!defaults.onlyNodes"
        class="location"
        v-for="room in rooms"
        :key="room.id"
        @click="emitLocation(room)"
        :style="{
          top: room.location.mapLatitude + 'px',
          left: room.location.mapLongitude + 'px',
          zIndex: room.location.mapAltitude + 10,
        }"
      >
        <!-- {{ room.name }} -->
        <div v-html="room.layout"></div>
      </div>
      <div
        v-show="!defaults.onlyNodes"
        class="location"
        v-for="floor in floors"
        :key="floor.id"
        :style="{
          top: floor.building.location.mapLatitude + 'px',
          left: floor.building.location.mapLongitude + 'px',
          zIndex: floor.building.location.mapAltitude,
        }"
      >
        <div v-html="floor.layout"></div>
      </div>
      <div
        v-show="defaults.onlyNodes"
        class="node"
        v-for="node in nodes"
        :key="node.id"
        :style="{
          top: node.mapLatitude + 'px',
          left: node.mapLongitude + 'px',
          zIndex: node.mapAltitude,
        }"
      >
        {{ node.id }}
      </div>
    </section>
  </section>
</template>

<script>
  import { watch } from "vue";

  export default {
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
      defaults: {
        required: true,
      },
      navigation: {
        required: false,
      },
    },
    setup(props) {
      watch([
        () => props.building,
        () => props.room,
        () => props.floors,
        () => props.nodes,
        () => props.campuses,
        () => props.defaults,
      ]);
    },
    methods: {
      emitLocation(location) {
        this.$emit("selectLocation", location);
      },
    },
  };
</script>

<style lang="scss" scoped>
  @import "@/assets/variables.scss";
  #canvas {
    margin: auto;
    position: relative;
    overflow: hidden;
    background-color: $bg-2;
    border-radius: $rad-1;
    .location {
      position: absolute;
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
</style>
