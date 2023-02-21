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
            <!-- Languages Support -->
            <li
              class="nav-item dropdown bg-dark text-white"
              v-show="features.languageSupport"
            >
              <a
                class="nav-link dropdown-toggle bg-dark text-white"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                Language
              </a>
              <ul class="dropdown-menu bg-dark">
                <li>
                  <a class="dropdown-item text-white" href="#">English</a>
                </li>
                <li>
                  <a class="dropdown-item text-white" href="#">Gaeilge</a>
                </li>
                <!-- <li><hr class="dropdown-divider" /></li>
                <li>
                  <a class="dropdown-item text-white" href="#">Something else here</a>
                </li> -->
              </ul>
            </li>
            <!-- Language End -->
          </ul>
          <!-- Routes End -->
          <!-- Dark Mode -->
          <a href="#" v-show="features.darkMode">
            <i class="fa-solid fa-moon"></i>
          </a>
          <!-- Dark Mode End -->
          <!-- Search -->
          <form class="d-flex" role="search" v-if="features.search">
            <input
              class="form-control me-2 text-white bg-dark"
              type="search"
              placeholder="Search"
              aria-label="Search"
            />
            <button class="btn btn-outline-success text-white" type="submit">
              Search
            </button>
          </form>
          <!-- Search End -->
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
          {
            enabled: true,
            name: "Sign In",
            to: "sign-in",
          },
          {
            enabled: true,
            name: "Admin Page",
            to: "admin",
          },
        ],
        features: {
          darkMode: false,
          languageSupport: false,
          search: false,
        },
      };
    },
  };
</script>
