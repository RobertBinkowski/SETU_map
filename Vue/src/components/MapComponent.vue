<template>
  <section id="mapComponent">
    <!-- <label for="departure">Departure</label><br />
    <select name="departure">
      <option
        v-for="location in locations"
        :key="location.id"
        :value="location.id"
      >
        {{ location.id }}
      </option></select
    ><br />
    <label for="destination">Destination</label><br />
    <select name="destination">
      <option
        v-for="location in locations"
        :key="location.id"
        :value="location.id"
      >
        {{ location.id }}
      </option></select
    ><br /> -->
    <LocationComponent :room="rooms[0]" v-show="false"></LocationComponent>
    <section
      id="canvas"
      :style="{ height: campus.height + 'px', width: campus.width + 'px' }"
    >
      <div
        class="location"
        :style="{ top: location.y + 'em', left: location.x + 'em' }"
        v-for="location in locations"
        :key="location.id"
      >
        <div v-html="location.layout"></div>
        {{ location.id }}
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
      locations: {
        required: true,
      },
      connections: {
        required: true,
      },
      rooms: {
        required: true,
      },
      campus: {
        required: true,
      },
    },
    methods: {
      searchTheArray() {
        // alert(locations.input.focus());
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
