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
      internalPath: [],
      userMarker: null,
      watchId: null,
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
      handler() {
        this.refreshMap();
      },
    },
    path: {
      deep: true,
      handler(path) {
        this.internalPath = path;
        // Refresh the Map
        this.refreshMap();
      },
    },
    campus: {
      deep: true,
      handler(campus) {
        // Check if latitude or longitude has changed
        this.updateMapLocation(campus.coordinates);
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
      this.createMarkers();
    });
  },
  methods: {
    refreshMap() {
      // Clear the markers
      this.clearMarkers();
      // Reinitialize the map
      this.initMap();
    },
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

      // Update Markers
      this.updateMarkers();
    },
    updateMarkers() {
      // Remove old markers
      this.clearMarkers();

      // Add and track User Location
      this.startTrackingUserLocation()
      // Create new markers
      this.createMarkers();
      // Create Path
      this.createPath();
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
    startTrackingUserLocation() {
      // If location is granted
      if (navigator.geolocation) {
        this.watchId = navigator.geolocation.watchPosition(
          (position) => {
            // Get User's location
            const userLocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude,
            };

            if (this.userMarker) {
              this.userMarker.setPosition(userLocation);
            } else {

              // Add a marker for the user's location
              const marker = new google.maps.Marker({
                position: userLocation,
                map: this.map,
                icon: {
                  path: google.maps.SymbolPath.CIRCLE,
                  scale: 10,
                  fillColor: "#4287f5",
                  fillOpacity: 1.0,
                  strokeColor: "#343536",
                  strokeWeight: .2,
                },
              });
              marker.addListener("click", () => {
                alert("Your current position");
              });
            }
          },
          (error) => {
            console.error("Error getting user location:", error);
          }
        );
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
            icon: {
              path: google.maps.SymbolPath.BACKWARD_CLOSED_ARROW,
              fillColor: "#07ddf5",
              fillOpacity: 1.0,
              strokeColor: "#343536",
              strokeWeight: .2,
              scale: 5,
            },
          });
          // Add click event to the marker
          marker.addListener("click", () => {
            this.onMarkerClick(location);
          });
          this.markers.push(marker);
        }
      });
    },
    createPath() {
      const pathCoordinates = this.internalPath.map((location) => {
        return {
          lat: parseFloat(location.coordinates.latitude),
          lng: parseFloat(location.coordinates.longitude),
        };
      });

      if (pathCoordinates.length > 0) {
        const pathLine = new google.maps.Polyline({
          path: pathCoordinates,
          geodesic: true,
          strokeColor: "#4287f5",
          strokeOpacity: 0,
          strokeWeight: 0,
          icons: [{
            icon: {
              path: 'M 0,0 L -1,-2 L 1,-2 z',
              strokeOpacity: .6,
              scale: 3,
            },
            offset: '0',
            repeat: '20px'
          }],
        });
        pathLine.setMap(this.map);
      }

      this.internalPath.forEach((location) => {
        if (location.coordinates != null) {
          const marker = new google.maps.Marker({
            position: {
              lat: parseFloat(location.coordinates.latitude),
              lng: parseFloat(location.coordinates.longitude),
            },
            map: this.map,
            icon: {
              url: "https://maps.google.com/mapfiles/ms/icons/red-dot.png", // Use Google Maps' standard red marker icon
              scaledSize: new google.maps.Size(1, 1),
            },
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
      // On marker click, update map location and open Navigation
      this.updateMapLocation($location.location.coordinates);
      this.emitLocation($location);
    },
    emitLocation(location) {
      this.$emit("selectLocation", location);
    },
    stopTrackingUserLocation() {
      // Stop tracking user location
      if (this.watchId) {
        navigator.geolocation.clearWatch(this.watchId);
        this.watchId = null;
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
      this.stopTrackingUserLocation();
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
