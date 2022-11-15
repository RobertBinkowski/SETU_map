<script>
  // A* -- Not working here
  // import "../../js/libraries/p5";
  // import "../../js/sketch";
  // import "../../js/spot";
  // import "../../js/map/mapfactory";
  // import "../../js/map/searchmap";
  // import "../../js/astarpathfinder";
  // import "../../js/libraries/p5.dom";

  export default {
    methods: {
      // Gets the GPS location of the user if given access
      getLocation() {
        var x = document.getElementById("location");
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(showPosition);
        } else {
          x.innerHTML =
            "Geolocation is not permitted or is not supported by this browser.";
        }
      },
      // Display location in the P tag
      showPosition(position) {
        var x = document.getElementById("location");
        x.innerHTML =
            "Latitude: " +
            position.coords.latitude +
            "<br>Longitude: " +
            position.coords.longitude;
      },
    },
  };
</script>

<template>
  <main>
    <button @click="getLocation()" class="btn btn-primary">
      Check Location
    </button>

    <p id="location"></p>
  </main>
</template>
