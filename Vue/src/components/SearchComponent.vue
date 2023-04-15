<template>
  <div>
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
          :value="campus.abbreviation"
        >
          {{ campus.name }}
        </option>
      </select>
    </div>
    <SearchEntry
      v-for="location in filteredLocations"
      :key="location"
      :location="location"
      :data="location"
      @click="emitLocation(location)"
    ></SearchEntry>
  </div>
</template>
<script>
  import { computed, watch } from "vue";
  import SearchEntry from "./SearchEntry.vue";

  export default {
    components: {
      SearchEntry,
    },
    props: {
      locations: {
        required: true,
      },
      campuses: {
        required: true,
      },
    },
    data() {
      return {
        searchTerm: "",
        selectedCampus: "",
      };
    },
    computed: {
      filteredLocations() {
        const filtered = this.locations.filter((location) => {
          if (!this.selectedCampus || this.selectedCampus === location.campus) {
            if (!this.searchTerm) {
              return true;
            }
            return location.name
              .toLowerCase()
              .includes(this.searchTerm.toLowerCase());
          }
          return false;
        });
        return filtered;
      },
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
  .search {
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
</style>
