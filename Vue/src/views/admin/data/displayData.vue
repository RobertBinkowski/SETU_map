<template>
  <table>
    <tr>
      <th v-for="(value, key) in data[0]" :key="key">{{ key }}</th>
      <th></th>
    </tr>
    <tr v-for="(value, key) in data" :key="key">
      <td v-for="(table, key) in value" :key="key">{{ table }}</td>
      <th>
        <button>Edit</button>
        <button>Delete</button>
        <button>Disable</button>
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
  table {
    color: gray;
    border-radius: 1em;
  }
</style>
