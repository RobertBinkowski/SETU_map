<template>
  <div>
    <h1>Map</h1>
    <GoogleMap
      v-if="campus"
      :locations="locations"
      :campus="campus"
      @selectLocation="selectLocation"
    ></GoogleMap>
    <div v-else>
      <h2>Loading...</h2>
    </div>
  </div>
</template>

<script>
  import GoogleMap from "./GoogleMap.vue";

  export default {
    name: "MapParentComponent",
    components: {
      GoogleMap,
    },
    props: {
      locations: {
        type: Array,
        required: true,
      },
      campus: {
        type: Object,
        required: true,
      },
    },
    methods: {
      selectLocation(location) {
        this.$emit("selectLocation", location);
      },
    },
  };
</script>
