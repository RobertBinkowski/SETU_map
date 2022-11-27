<script>
  // A* -- Not working here
  // import "../../js/libraries/p5";
  // import "../../js/sketch";
  // import "../../js/spot";
  // import "../../js/map/mapfactory";
  // import "../../js/map/searchmap";
  // import "../../js/astarpathfinder";
  // import "../../js/libraries/p5.dom";

  import { escapeHtmlComment } from "@vue/shared";

  export default {
    created() {
      const success = (position) => {
        const latitude = position.coords.latitude;
        const longitude = position.coords.longitude;

        // var x = document.getElementById("location");
        // x.innerHTML = "Latitude: " + latitude + "<br>Longitude: " + longitude;
        // Do something with the position
      };

      const error = (err) => {
        console.log(error);
      };
      // This will open permission popup
      navigator.geolocation.getCurrentPosition(success, error);
    },
  };
</script>

<template>
  <main>
    <h1>Main</h1>
  </main>
</template>
