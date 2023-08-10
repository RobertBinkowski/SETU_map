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
    data() {
      return {
        map: null,
        markers: [],
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
    },
    watch: {
      locations: {
        deep: true,
        handler(newLocations, oldLocations) {
          this.updateMarkers(newLocations);
        },
      },
      campus: {
        deep: true,
        handler(newCampus, oldCampus) {
          // Check if latitude or longitude has changed
          if (
            newCampus.coordinates.latitude !== oldCampus.coordinates.latitude ||
            newCampus.coordinates.longitude !== oldCampus.coordinates.longitude
          ) {
            this.updateMapLocation(newCampus.coordinates);
          }
        },
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
            lat: parseFloat(this.campus.coordinates.latitude),
            lng: parseFloat(this.campus.coordinates.longitude),
          },
          zoom: parseFloat(this.campus.coordinates.zoom),
          selectedCampus: null,
          mapTypeControl: false,
          styles: [
            {
              featureType: "poi",
              stylers: [{ visibility: "off" }],
            },
          ],
        });

        // Create markers
        this.createMarkers();
      },
      updateMarkers() {
        // Remove old markers
        this.clearMarkers();

        // Create new markers
        this.createMarkers();
      },
      updateMapLocation($coordinates) {
        // Check if map is initialized
        if (this.map) {
          // Update map location
          this.map.setCenter({
            lat: parseFloat($coordinates.latitude),
            lng: parseFloat($coordinates.longitude),
          });
          // Update map zoom
          this.map.setZoom(parseFloat($coordinates.zoom));
        }
      },
      createMarkers() {
        // Create markers
        this.locations.forEach((location) => {
          if (location.location.coordinates != null) {
            const marker = new google.maps.Marker({
              position: {
                lat: parseFloat(location.location.coordinates.latitude),
                lng: parseFloat(location.location.coordinates.longitude),
              },
              map: this.map,
            });
            // Add click event to the marker
            marker.addListener("click", () => {
              this.onMarkerClick(location.location);
            });
            this.markers.push(marker);
          }
        });
      },
      clearMarkers() {
        // Remove all markers
        this.markers.forEach((marker) => {
          marker.setMap(null);
        });
        this.markers = [];
      },
      onMarkerClick($location) {
        this.updateMapLocation($location.coordinates);

        this.emitLocation($location);
      },
      emitLocation(location) {
        this.$emit("selectLocation", location);
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
