<template>
  <main id="about">
    <h1>About</h1>
    <h2>South East Technological University Map (SETU Map)</h2>
    <p>
      This project was designed and developed by
      <a href="https://robertbinkowski.me/">Robert Binkowski (C00237917)</a
      ><br />
      as a final year project for the 4th year in <b>Software Development</b>.
      <br />
      Supervised by <b>Oisin Cawley</b>. <br />
      The project was started in September 2022 and finished in June 2022.
    </p>
    <h2>Technologies Used</h2>
    <dl>
      <dt>Front-End</dt>
      <dd>HTML</dd>
      <dd>SCSS</dd>
      <dd>Vue.js</dd>
      <dt>Back-End</dt>
      <dd>PHP</dd>
      <dt>Database</dt>
      <dd>MySQL</dd>
    </dl>
    <div class="technologies">
      <img src="../../public/Vue_Logo.svg" alt="Vue" /><br />
      <img src="../../public/Bootstrap_Logo.png" alt="Bootstrap" /><br />
      <img src="../../public/PHP_Logo.png" alt="MySQL" /><br />
      <img src="../../public/MySQL_Logo.png" alt="MySQL" /><br />
    </div>
    <dl>
      <dt>Algorithms</dt>
      <dd>A* - Searching Algorithm</dd>
      <dd>Haversine Formula - Geological Distance</dd>
    </dl>
  </main>
</template>

<style scoped lang="scss">
  @import "@/assets/variables.scss";
  #about {
    text-align: center;
  }
  a {
    color: $acc-1;
    &:hover {
      color: $acc-2;
    }
  }
  .technologies {
    display: inline-flex;
    img {
      margin: 1em;
      height: 4em;
    }
  }
</style>
