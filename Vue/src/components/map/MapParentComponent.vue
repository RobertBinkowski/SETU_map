<template>
  <div>
    <h1>Map</h1>
    <GoogleMap
      v-if="campus"
      :locations="locations"
      :campus="campus"
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
  };
</script>
