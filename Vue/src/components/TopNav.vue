<template>
  <header class="wrapper">
    <nav class="navbar navbar-expand-lg bg-dark text-white">
      <div class="container-fluid">
        <h1 class="navbar-brand text-white">{{ title }}</h1>
        <!-- Expand button -->
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Expand Button End -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Routes -->
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <RouterLink
              v-for="route in routes"
              :key="route"
              v-show="route.enabled"
              class="nav-item nav-link text-white"
              :to="route.to"
              >{{ route.name }}</RouterLink
            >
            <RouterLink
              v-for="route in adminRoutes"
              :key="route"
              class="nav-item nav-link text-white"
              :to="route.to"
              >{{ route.name }}</RouterLink
            >
          </ul>
          <!-- Routes End -->
          <button class="btn btn-primary" v-if="token" @click="logout">
            Logout
          </button>
        </div>
      </div>
    </nav>
  </header>
</template>

<style lang="scss" scoped>
  .wrapper {
    max-width: 1600px;
    margin: auto;
  }
  .navbar {
    .nav-item {
      font-weight: bold;
    }
    .fa-solid {
      padding-right: 1em;
      font-size: 1.4em;
    }
  }
</style>

<script>
  export default {
    data() {
      return {
        title: "SETU Map",
        routes: [
          {
            enabled: true,
            name: "Home",
            to: "/",
          },
          {
            enabled: true,
            name: "About",
            to: "about",
          },
        ],
        adminRoutes: [
          {
            enabled: true,
            logged: false,
            name: "Admin Page",
            to: "admin",
          },
        ],
        token: localStorage.getItem("authToken"),
        features: {
          darkMode: false,
          languageSupport: false,
          search: false,
        },
      };
    },
    methods: {
      logout() {
        localStorage.removeItem("authToken");
        alert("Logged Out");
        this.$router.push({ name: "Login" });
      },
    },
  };
</script>
