<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
#main{
  display:grid;
  width:100%;
  height:100vh;
  grid-template-columns:200px auto;
  margin: 10px;
  gap:10px
}
</style>
<template>
  <div id="main">
    <nav>
      <div class="ui segment">
        <img class="ui fluid centered image" alt="Elek logo" src="./assets/mesh.png"/>
        <p></p>
        <h2 class="ui header teal">Elek projesi</h2>
      </div>
      

      <div class="ui vertical fluid menu">
        <a href="#/" class="teal item">
          Metin Listesi
        </a>
        <a href="#/sentence-list" class="item">
          Cümle Listesi
        </a>
        <a href="#/word-list" class="item">
          Söz Listesi
        </a>
      </div>
    </nav>
    <section>
      <router-view></router-view>
    </section>
  </div>
</template>

<script>

export default {
  name: 'ElekProject',
  components: {
  }
}
</script>

