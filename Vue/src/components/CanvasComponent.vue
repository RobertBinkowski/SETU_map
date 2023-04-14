<template>
  <section>
    <canvas
      ref="canvas"
      :height="campus.height"
      :width="campus.width"
      @click="handleClick"
    ></canvas>
  </section>
</template>

<script>
  import { watch } from "vue";

  export default {
    data() {
      return {
        locations: [
          {
            x: 100,
            y: 100,
            label: "Location A",
            svg: '<circle cx="0" cy="0" r="10" fill="red" />',
          },
          {
            x: 200,
            y: 200,
            label: "Location B",
            svg: '<rect x="-10" y="-10" width="20" height="20" fill="blue" />',
          },
          {
            x: 300,
            y: 300,
            label: "Location C",
            svg: '<polygon points="-10,-10 10,-10 0,10" fill="green" />',
          },
        ],
      };
    },
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
      watch([
        () => props.building,
        () => props.room,
        () => props.floors,
        () => props.nodes,
        () => props.campuses,
        () => props.defaults,
      ]);
    },
    mounted() {
      const canvas = this.$refs.canvas;
      const ctx = canvas.getContext("2d");

      this.locations = [];

      for (const location of locations) {
        const svg = new Blob([location.svg], {
          type: "image/svg+xml;charset=utf-8",
        });
        const url = URL.createObjectURL(svg);

        const img = new Image();
        img.src = url;
        img.onload = () => {
          ctx.drawImage(img, location.x - 10, location.y - 10, 20, 20);

          ctx.font = "14px sans-serif";
          ctx.textAlign = "center";
          ctx.fillText(location.label, location.x, location.y + 30);

          const button = {
            x: location.x - 10,
            y: location.y - 10,
            width: 20,
            height: 20,
            data: location,
          };
          this.locations.push(button);

          URL.revokeObjectURL(url);
        };
      }
    },
    methods: {
      handleClick(event) {
        const rect = event.target.getBoundingClientRect();
        const mouseX = event.clientX - rect.left;
        const mouseY = event.clientY - rect.top;

        for (const button of this.locations) {
          if (
            mouseX >= button.x &&
            mouseX <= button.x + button.width &&
            mouseY >= button.y &&
            mouseY <= button.y + button.height
          ) {
            const message = `Location: ${button.data.label}\nCoordinates: (${button.data.x}, ${button.data.y})`;
            window.prompt("Location Details", message);
            break;
          }
        }
      },
    },
  };
</script>

<style lang="scss" scoped>
  @import "@/assets/variables.scss";
  canvas {
    background-color: $acc-1;
  }
</style>
