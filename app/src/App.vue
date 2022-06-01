<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
body{
  padding:0px;
  margin:0px;
}
main{
  display:grid;
  width:100%;
  height:100vh;
  grid-template-columns:150px auto;
}
nav{
  background: #666
}
</style>
<template>
  <main>
    <nav>
      <img alt="Vue logo" src="./assets/logo.png">
      <ul>
        <li><a href="#/">Text List</a></li>
        <li><a href="#/sentence-list">Sentence List</a></li>
        <li><a href="#/word-list">Word List</a></li>
      </ul>
    </nav>
    <section>

    </section>
  </main>
</template>

<script>

export default {
  name: 'App',
  components: {
  }
}
</script>

