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
      connections: {
        required: false,
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

        // Draw connections
        if (props.connections) {
          drawConnections();
        }
      }

      function drawConnections() {
        ctx.value.lineWidth = 2;
        ctx.value.strokeStyle = "white";

        props.connections.forEach((connection) => {
          const locationOne = props.buildings.find(
            (building) => building.id === connection.locationOne.id
          );
          const locationTwo = props.buildings.find(
            (building) => building.id === connection.locationTwo.id
          );

          if (locationOne && locationTwo) {
            ctx.value.beginPath();
            ctx.value.moveTo(
              locationOne.location.mapLatitude,
              locationOne.location.mapLongitude
            );
            ctx.value.lineTo(
              locationTwo.location.mapLatitude,
              locationTwo.location.mapLongitude
            );
            ctx.value.stroke();
          }
        });
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

      function drawConnections() {
        ctx.value.lineWidth = 2;
        ctx.value.strokeStyle = "red";

        // Filter connections based on custom criteria
        // const filteredConnections =
        //   props.connections.filter(shouldDrawConnection);

        filteredConnections.forEach((connection) => {
          const locationOne = props.buildings.find(
            (building) => building.id === connection.locationOne.id
          );
          const locationTwo = props.buildings.find(
            (building) => building.id === connection.locationTwo.id
          );

          if (locationOne && locationTwo) {
            ctx.value.beginPath();
            ctx.value.moveTo(
              locationOne.location.mapLatitude,
              locationOne.location.mapLongitude
            );
            ctx.value.lineTo(
              locationTwo.location.mapLatitude,
              locationTwo.location.mapLongitude
            );
            ctx.value.stroke();
          }
        });
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
  #mapComponent {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
  }
  #canvas {
    margin: auto;
    position: relative;
    overflow: hidden;
    background-color: $bg-2;
    border-radius: $rad-1;
  }
</style>
