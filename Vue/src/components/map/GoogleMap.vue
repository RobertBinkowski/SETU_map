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
          selectedCampus: null,
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
      createMarkers() {
        this.locations.forEach((location) => {
          const marker = new google.maps.Marker({
            position: {
              lat: parseFloat(location.geoLatitude),
              lng: parseFloat(location.geoLongitude),
            },
            map: this.map,
          });

          // Add click event to the marker
          marker.addListener("click", () => {
            this.onMarkerClick(location);
          });

          this.markers.push(marker);
        });
      },
      clearMarkers() {
        this.markers.forEach((marker) => {
          marker.setMap(null);
        });
        this.markers = [];
      },
      onMarkerClick(location) {
        // For demonstration purposes, display an alert with the location name
        alert(`Clicked on location: ${location.type}`);
        // You can replace the above with any action you'd like to perform
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
