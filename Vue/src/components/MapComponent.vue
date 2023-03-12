<template>
  <section id="mapComponent">
    <LocationComponent
      :room="rooms[0]"
      v-show="locationContent"
    ></LocationComponent>
    <div v-show="demo" id="demo">
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
        v-show="!onlyNodes"
        class="location"
        v-for="location in rooms"
        :key="location.id"
        :style="{
          top: nodes[location.location_id - 1].y + 'em',
          left: nodes[location.location_id - 1].x + 'em',
          zIndex: nodes[location.location_id - 1].z + 1,
        }"
      >
        {{ location.name }}
        <div v-html="location.layout"></div>
      </div>
      <div
        v-show="!onlyNodes"
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
        {{ location.name }}
        <div v-html="location.layout"></div>
      </div>
      <div
        v-show="onlyNodes"
        class="node"
        v-for="node in nodes"
        :key="node.id"
        :style="{
          top: node.y + 'em',
          left: node.x + 'em',
          zIndex: node.z,
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
