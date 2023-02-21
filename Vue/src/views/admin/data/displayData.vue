<template>
  <table>
    <tr>
      <th v-for="(value, key) in data[0]" :key="key">{{ key }}</th>
      <th></th>
    </tr>
    <tr v-for="(value, key) in data" :key="key">
      <td v-for="(table, key) in value" :key="key">{{ table }}</td>
      <th>
        <button :value="value.id">Edit</button>
        <button :value="value.id">Delete</button>
        <button :value="value.id">Disable</button>
      </th>
    </tr>
  </table>
</template>

<script>
  export default {
    props: ["data"],
  };
</script>

<style lang="scss" scoped>
  @import "@/assets/variables.scss";
  table {
    background-color: $acc-1;
    color: $txt-1;
    border: 1px solid $acc-2;
  }
</style>
