<template>
  <div>
    <h1>Map</h1>
    <div id="map"></div>
  </div>
</template>

<script>
  import { Loader } from "@googlemaps/js-api-loader";
  export default {
    name: "GoogleMap",
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
    watch: {
      "campus.lat": function (newLat, oldLat) {
        // React to changes in the 'lat' property
        this.updateMapLocation();
      },
      "campus.lng": function (newLng, oldLng) {
        // React to changes in the 'lng' property
        this.updateMapLocation();
      },
    },
    mounted() {
      // Replace YOUR_API_KEY with your actual API key
      const loader = new Loader({
        apiKey: "AIzaSyBQODOwT6hgWsOyWQPTf7C0B2Rp9m2u5uI",
        version: "weekly", // Use a specific version if needed
      });

      loader.load().then(() => {
        this.initMap();
      });
    },
    methods: {
      initMap() {
        // Initialize the map
        this.map = new google.maps.Map(document.getElementById("map"), {
          center: {
            lat: parseFloat(this.campus.lat),
            lng: parseFloat(this.campus.lng),
          }, // coordinates
          zoom: parseFloat(this.campus.size),
        });
      },
      updateMapLocation() {
        if (this.map) {
          // If the map is initialized, update its center based on new lat/lng values
          this.map.setCenter({
            lat: parseFloat(this.campus.lat),
            lng: parseFloat(this.campus.lng),
          });
        }
      },
    },
    beforeDestroy() {
      if (this.map) {
        // Clean up the map instance
        google.maps.event.clearInstanceListeners(this.map);
        google.maps.event.clearInstanceListeners(this.map.data);
        google.maps.event.clearInstanceListeners(this.map.getStreetView());
        this.map = null;
      }
    },
  };
</script>

<style lang="scss">
  @import "@/assets/variables.scss";

  #map {
    height: 80vh;
    width: 100%;
    border-radius: $rad-1;
  }
</style>
