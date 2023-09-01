<template>
  <main>
    <h1>Users</h1>
    <div class="table">
      <NavigationComponent></NavigationComponent>
      <table>
        <tr>
          <th>ID</th>
          <th>Enabled</th>
          <th>Username</th>
          <th>Email</th>
          <th>Password</th>
          <th>Created</th>
          <th>Type</th>
          <th>Privileges</th>
          <th v-show="edit == true"></th>
        </tr>
        <tr v-for="(value, key) in  users " :key="key">
          <td>{{ value.id }}</td>
          <td>{{ value.enabled }}</td>
          <td>{{ value.username }}</td>
          <td>{{ value.email }}</td>
          <td>{{ value.password }}</td>
          <td>{{ value.created }}</td>
          <td>{{ value.privileges ? value.privileges.name : '' }}</td>
          <td v-if="value.privileges">
            users: {{ value.privileges.users }} <br>
            logs: {{ value.privileges.logs }} <br>
            searches: {{ value.privileges.searches }} <br>
            details: {{ value.privileges.details }} <br>
            images: {{ value.privileges.images }} <br>
          </td>
          <td v-else>
            -
          </td>
          <td v-show="edit == true">
            <button :value="value.id">Edit</button>
            <button :value="value.id">Delete</button>
            <button :value="value.id">Disable</button>
          </td>
        </tr>
      </table>
      <!-- <button>Create New</button> -->
    </div>
  </main>
</template>

<script>
import NavigationComponent from "@/components/admin/NavigationComponent.vue";
import axios from "axios";
import { ref } from "vue";

export default {
  components: {
    NavigationComponent,
  },
  setup() {
    let users = ref([]);

    async function getUsers() {
      const { data } = await axios.get("http://localhost:8000/api/users");
      users.value = data;
    }

    getUsers();
    return { users };
  },
  methods: {
    setData: function () {
      // Not Working
      // data.value = locations;
      // alert(data.value);
    },
  },
};
</script>

<style scoped lang="scss">
@import "@/assets/variables.scss";

.top {
  padding: .1em;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;

  a {
    padding: 1em;
    margin: .1em;
    border-radius: $rad-1;
    border-radius: $rad-1;
    background-color: $acc-1-d;
    color: $acc-1;
  }
}
</style>
