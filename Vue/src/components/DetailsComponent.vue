<template>
  <div id="locationDetails">
    <span class="close" @click="$emit('close')">X</span>
    <div v-show="image.src != '' && image.enabled" class="image">
      <img :src="image.src" :alt="image.name" />
    </div>
    <div class="details">
      <h1>{{ room.name }}</h1>
      <span class="building">{{ room.building.name }}</span>
      <!-- <br /> -->
      <p class="info">{{ room.info }}</p>
    </div>
    <div class="options">
      <button @click="$emit('navigate', room)">navigate</button>
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
      image: {
        required: false,
      },
    },
    methods: {
      submit() {
        this.$emit("navigate", location);
        this.$emit("close");
      },
    },
    setup(props) {
      // Watch for changes
      watch(() => props.room);

      let image = ref([]);

      // Get Image by ID
      async function getImage() {
        const { data } = await axios.get(
          "http://localhost:8000/api/images/" + props.image
        );
        image.value = data;
      }

      getImage();
      return { image };
    },
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
    background-color: $c-bg-1;
    box-shadow: $shadow;
    width: 20em;
    overflow: hidden;
    .close {
      position: absolute;
      cursor: pointer;
      font-size: 1.3em;
      top: 0.1em;
      right: 0.4em;
      z-index: 2;
      font-weight: bold;
      text-shadow: 0 0 3px $txt-2, 0 0 5px $txt-2;
      transition: $tr-f;
      &:hover {
        color: $close;
      }
    }
    .details {
      padding: 1em;
      color: $txt-2;
      font-weight: 900;
      text-shadow: $t-shadow;
      .building {
        color: $acc-2;
      }
    }
    .image {
      height: 15em;
      width: 100%;
      overflow: hidden;
      border-radius: $rad-1;
      img {
        width: 100%;
        background-position: bottom;
        background-repeat: no-repeat;
        background-size: cover;
      }
    }
  }
</style>
