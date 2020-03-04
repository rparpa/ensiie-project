<template>
  <div>
    <Header/>
    <Nav v-if="this.$root.$data.user != undefined && this.$root.$data.user.role == 1" class="navButtons"/>
    <Map/>
  </div>
</template>


<style>
  .navButtons{
    position: fixed;
    left: 0px;
    top: 20vw;
    z-index: 99;
  }
</style>

<script>
// @ is an alias to /src
import Map from '@/components/Map.vue'
import Nav from '@/components/Navigation.vue'
import Header from '@/components/Header.vue'

export default {
  name: 'Home',
  components: {
    Map,
    Nav,
    Header
  }
}
</script>
