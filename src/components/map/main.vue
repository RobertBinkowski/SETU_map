<template>
  <section>{{ info }}</section>
</template>

<script>
  import axios from "axios";
  // export default {
  //   created() {
  //     const success = (position) => {
  //       const latitude = position.coords.latitude;
  //       const longitude = position.coords.longitude;

  //       // var x = document.getElementById("location");
  //       // x.innerHTML = "Latitude: " + latitude + "<br>Longitude: " + longitude;
  //       // Do something with the position
  //     };

  //     const error = (err) => {
  //       console.log(error);
  //     };
  //     // This will open permission popup
  //     navigator.geolocation.getCurrentPosition(success, error);
  //   },
  // };
  export default {
    data() {
      return {
        info: null,
      };
    },
    mounted() {
      axios
        .get("http://localhost:8000/room")
        .then((response) => (this.info = response));
    },
  };
</script>
