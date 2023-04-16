<template>
  <section id="mapComponent">
    <canvas
      id="canvas"
      ref="canvas"
      :width="campus.width"
      :height="campus.height"
      @click="handleClick"
    ></canvas>
  </section>
</template>

<script>
  import { watch, ref, onMounted } from "vue";

  export default {
    props: {
      buildings: {
        required: true,
      },
      rooms: {
        required: true,
      },
      floors: {
        required: true,
      },
      nodes: {
        required: true,
      },
      campus: {
        required: true,
      },
      defaults: {
        required: true,
      },
    },
    setup(props) {
      const canvas = ref(null);
      const ctx = ref(null);

      onMounted(() => {
        ctx.value = canvas.value.getContext("2d");
        drawElements();
      });

      watch(
        [
          () => props.buildings,
          () => props.rooms,
          () => props.floors,
          () => props.nodes,
          () => props.campus,
          () => props.defaults,
        ],
        () => {
          drawElements();
        }
      );

      function drawElements() {
        if (!ctx.value) return;

        ctx.value.clearRect(0, 0, props.campus.width, props.campus.height);

        // Draw buildings
        props.buildings.forEach((building) => {
          drawSvg(
            building.layout,
            building.location.mapLatitude,
            building.location.mapLongitude
          );
        });

        // Draw other elements (rooms, floors, nodes) on the canvas here
      }

      function drawSvg(svg, x, y) {
        const image = new Image();
        image.src = "data:image/svg+xml;base64," + btoa(svg);
        image.onload = () => {
          ctx.value.drawImage(image, x, y);
        };
      }

      function handleClick(event) {
        // Handle canvas click events here
      }

      return {
        canvas,
        handleClick,
      };
    },
    methods: {
      emitLocation(location) {
        this.$emit("selectLocation", location);
      },
    },
  };
</script>

<style lang="scss" scoped>
  @import "@/assets/variables.scss";
  #canvas {
    margin: auto;
    position: relative;
    overflow: hidden;
    background-color: $bg-2;
    border-radius: $rad-1;
  }
</style>
