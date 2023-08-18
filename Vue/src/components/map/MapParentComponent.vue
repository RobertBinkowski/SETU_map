<template>
  <div>
    <GoogleMap
      v-if="campus"
      :locations="locations"
      :campus="campus"
      :path="internalPath"
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
    data() {
      return {
        internalPath: [],
      };
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
      path: {
        type: Array,
        required: false,
      },
    },
    watch: {
      locations: {
        deep: true,
      },
      path: {
        deep: true,
        handler(newPath) {
          this.internalPath = newPath;
        },
      },
    },

    methods: {
      selectLocation(location) {
        this.$emit("selectLocation", location);
      },
    },
  };
</script>
