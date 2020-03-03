<template>
  <div class="about">
    <Header/>
    <Nav class="navButtons"/>
    <h1>This the admin page</h1>
  </div>
</template>

<style>
  .navButtons{
    position: fixed;
    left: 0px;
    top: 20vw;
    z-index: 99999;
  }
</style>

<script>
// @ is an alias to /src
import Header from '@/components/Header.vue'
import Nav from '@/components/Navigation.vue'

export default {
  name: 'Admin',
  components: {
    Header,
    Nav
  }
}
</script>
