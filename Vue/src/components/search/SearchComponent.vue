<template>
  <div id="searchDiv">
    <div class="search">
      <input
        type="text"
        name="search"
        class="text"
        placeholder="Search"
        v-model="searchTerm"
      />
      <select name="campus" class="campus" v-model="selectedCampus">
        <option
          v-for="campus in campuses"
          :key="campus"
          v-show="campus.enabled"
          :value="campus"
        >
          {{ campus.details.name }}
        </option>
      </select>
    </div>
    <SearchEntry
      v-for="location in filteredRooms"
      :key="location"
      :location="location.details"
      @selectLocation="selectLocation"
    ></SearchEntry>
  </div>
</template>
<script>
  import { watch } from "vue";
  import SearchEntry from "./SearchEntry.vue";

  export default {
    components: {
      SearchEntry,
    },
    props: {
      rooms: {
        type: Array,
        required: true,
      },
      buildings: {
        type: Array,
        required: false,
      },
      campuses: {
        type: Array,
        required: true,
      },
    },
    data() {
      return {
        searchTerm: "",
        selectedCampus: this.campuses[0],
      };
    },
    computed: {
      filteredRooms() {
        if (this.searchTerm == "") {
          return null;
        }
        return this.rooms.filter(
          (room) =>
            room.building.campus.id == this.selectedCampus.id ||
            room.details.name
              .toLowerCase()
              .includes(this.searchTerm.toLowerCase())
        );
      },
    },
    methods: {
      selectLocation(location) {
        this.$emit("selectLocation", location);
      },
    },
    watch: {
      campuses: {
        immediate: true,
        handler(newValue) {
          if (newValue && newValue[0]) {
            this.selectedCampus = newValue[0];
          }
        },
      },
      selectedCampus(newVal) {
        this.$emit("updateSelectedCampus", newVal);
      },
    },
  };
</script>

<style lang="scss" scoped>
  @import "@/assets/variables.scss";
  #searchDiv {
    padding: 1em;
    .search {
      border: $acc-1 2px solid;
      border-radius: 1em;
      width: 100%;
      max-width: 50em;
      margin: auto;
      padding: 0.2em;
      background-color: #ffffff00;
      color: $txt-1;
      .text {
        font-size: 1.5em;
        height: 2em;
        width: 70%;
        border: none;
        border-radius: $rad-1 0 0 $rad-1;
        outline: none;
        text-align: center;
      }
      .campus {
        font-size: 1.5em;
        height: 2em;
        width: 30%;
        text-align: center;
        border: none;
        border-left: 2px solid $acc-1;
        border-radius: 0 $rad-1 $rad-1 0;
        outline: none;
      }
    }
  }
</style>
