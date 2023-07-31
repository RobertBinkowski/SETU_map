<template>
  <div>
    <div v-if="campus" id="map"></div>
    <div v-else>
      <h2>Loading...</h2>
    </div>
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
      locations: {
        deep: true,
        handler(newLocations, oldLocations) {
          // React to changes in the 'locations' prop
          // Update the map with new location data if needed
          // Example: Call a method to update markers or draw new shapes on the map
        },
      },
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
        apiKey: import.meta.env.VITE_GOOGLE_MAPS_API,
        version: "weekly", // Use a specific version if needed
      });

      loader.load().then(() => {
        this.initMap();
      });
    },
    methods: {
      initMap() {
        if (!this.campus) {
          // Campus data is not available yet, do not initialize the map
          return;
        }

        // Initialize the map
        this.map = new google.maps.Map(document.getElementById("map"), {
          center: {
            lat: parseFloat(this.campus.lat),
            lng: parseFloat(this.campus.lng),
          },
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
          this.map.setZoom(parseFloat(this.campus.size));
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
