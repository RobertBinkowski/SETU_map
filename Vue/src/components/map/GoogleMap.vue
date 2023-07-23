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
    data() {
      return {
        map: null,
      };
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
          center: { lat: 52.827238858200715, lng: -6.936114093664326 }, // IT Carlow coordinates
          zoom: 18,
        });
      },
    },
  };
</script>

<style>
  #map {
    height: 80vh;
    width: 100%;
  }
</style>
