<template>
  <header class="wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
      <RouterLink class="nav-item nav-link" to="/">Home</RouterLink>
      <RouterLink class="nav-item nav-link" to="/about">About</RouterLink>
      <RouterLink class="nav-item nav-link" to="/signin">Sign In</RouterLink>
      <!-- Search  -->
      <form class="form-inline">
        <input
          class="form-control mr-sm-2"
          type="search"
          placeholder="Search"
          aria-label="Search"
        />
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
          Search
        </button>
      </form>
    </nav>
  </header>
</template>

<style lang="scss" scoped>
  .navbar {
    display: flex;
    align-items: center;
    .nav-item {
      font-weight: bold;
    }
  }
</style>
