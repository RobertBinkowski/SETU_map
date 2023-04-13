<template>
  <div id="locationDetails">
    <div class="images">
      <!-- <img :src="images[0]" alt="images" /> -->
    </div>
    <div class="details">
      <h1>{{ room.name }}</h1>
      <p>{{ room.type }}</p>
      <p>{{ room.size }}</p>
      <p>{{ room.info }}</p>
    </div>
    <div class="options">
      <button @click="$emit('navigate')">navigate</button>
    </div>
  </div>
</template>

<script>
  import axios from "axios";
  import { ref, watch } from "vue";

  export default {
    props: {
      room: {
        required: true,
      },
    },
    methods: {
      submit() {
        this.$emit("navigate");
      },
    },
    setup(props) {
      watch(() => props.room);
    },
    // setup() {
    //   let images = ref([]);

    //   async function getImages() {
    //     const { data } = await axios.get("http://localhost:8000/api/images");
    //     images.value = data;
    //   }

    //   getImages();
    //   return { images };
    // },
  };
</script>

<style lang="scss" scoped>
  @import "@/assets/variables.scss";
  #locationDetails {
    position: fixed;
    z-index: 1000;
    top: 5em;
    left: 2em;
    border-radius: $rad-1;
    background-color: $bg-2;
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
