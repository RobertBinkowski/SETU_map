<template>
  <div id="locationDetails">
    <div class="images">
      <img :src="images[0]" alt="images" />
    </div>
    <div class="details">
      <h1>{{ room.name }}</h1>
      <p>{{ room.type }}</p>
      <p>{{ room.size }}</p>
      <p>{{ room.info }}</p>
    </div>
    <div class="options">
      <button>navigate</button>
    </div>
  </div>
</template>

<script>
  import axios from "axios";
  import { ref } from "vue";

  export default {
    props: {
      room: {
        required: true,
      },
    },
    setup() {
      let images = ref([]);

      async function getImages() {
        const { data } = await axios.get("http://localhost:8000/api/images");
        images.value = data;
      }

      getImages();
      return { images };
    },
  };
</script>

<style lang="scss" scoped>
  @import "@/assets/variables.scss";
  #locationDetails {
    position: fixed;
    z-index: 10;
    top: 5em;
    left: 2em;
    border-radius: $rad-1;
    background-color: gray;
    width: 20em;
    overflow: hidden;
    .details {
      padding: 1em;
    }
    .images {
      height: 10em;
    }
  }
</style>
