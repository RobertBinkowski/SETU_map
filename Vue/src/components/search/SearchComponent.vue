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
          :value="campus.id"
        >
          {{ campus.name }}
        </option>
      </select>
    </div>
    <SearchEntry
      v-for="location in filteredRooms"
      :key="location"
      :location="location"
      :data="location"
      @click="emitLocation(location)"
    ></SearchEntry>
    <SearchEntry
      v-for="location in filteredBuildings"
      :key="location"
      :location="location"
      :data="location"
      @click="emitLocation(location)"
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
        required: true,
      },
      buildings: {
        required: false,
      },
      campuses: {
        required: true,
      },
    },
    data() {
      return {
        searchTerm: "",
        selectedCampus: "1",
      };
    },
    computed: {
      filteredRooms() {
        if (this.searchTerm == "") {
          return null;
        }
        return this.rooms.filter(
          (room) =>
            room.building.campus.id == this.selectedCampus &&
            room.name.toLowerCase().includes(this.searchTerm.toLowerCase())
        );
      },
      filteredBuildings() {
        if (this.searchTerm == "") {
          return null;
        }
        return this.buildings.filter(
          (building) =>
            building.campus.id == this.selectedCampus &&
            building.name.toLowerCase().includes(this.searchTerm.toLowerCase())
        );
      },
    },
    methods: {
      emitLocation(location) {
        this.$emit("selectLocation", location);
      },
    },
    watch: {
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
