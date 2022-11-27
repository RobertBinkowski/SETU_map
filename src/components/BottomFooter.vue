<template>
  <!-- Footer -->
  <footer class="bg-dark text-center text-white">
    <!-- Logo -->
    <img src="./icons/logo.png" alt="Logo" class="navLogo" />
    <!-- Grid container -->
    <div class="container p-4">
      <!-- Linkedin -->
      <a
        class="btn btn-floating m-1"
        href="https://www.linkedin.com/in/robert-binkowski-9bb565195/"
        role="button"
        ><i class="fab fa-linkedin-in"></i
      ></a>

      <!-- Github -->
      <a
        class="btn btn-floating m-1"
        href="https://github.com/RobertBinkowski"
        role="button"
        ><i class="fab fa-github"></i
      ></a>
    </div>
    <!-- Grid container -->
    <p>
      Project designed and developed <br />
      by <br />
      <a href="https://robertbinkowski.github.io/RobertBinkowski/">
        <b>Robert Binkowski</b> - <b>C00237917</b></a
      >
      <br />
      South East
      <i>Technological University Map</i>
    </p>
  </footer>
</template>

<style lang="scss" scoped>
  @import "./../assets/variables.scss";
  footer {
    overflow: hidden;
    text-align: center;
    padding: 0;
    padding: 3em 0 3em 0;
    width: 100vw;
    min-height: 10em;
    background-color: rgb(61, 100, 185);
    .navLogo {
      height: 7em;
      padding-bottom: 2em;
    }
  }
</style>
