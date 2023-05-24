<script setup>
import { RouterLink, RouterView } from 'vue-router'
import FooterComponent from './components/FooterComponent.vue'
import HeaderComponent from './components/HeaderComponent.vue'
</script>

<template>
  <!-- <header>
    <HeaderComponent />
  </header>
  <main>
    <RouterView />
  </main> -->
  <footer>
     <FooterComponent /> 
  </footer>
</template>

<style>
#app {
  font-family: ubuntu;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
</style>
