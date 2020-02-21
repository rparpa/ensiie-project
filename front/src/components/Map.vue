<template>
  <b-container class="map-container">
    <b-jumbotron>
      <b-row>
        <img src="../assets/map.jpg" height="500" width="700" class="mr-5">
        <MapSettings />
      </b-row>
    </b-jumbotron>
  </b-container>
</template>

<script>
import MapSettings from './MapSettings.vue'

export default {
  components: {
    MapSettings
  }
}
</script>

<style scoped>
  .map-container {
    margin-top: 20px
  }
</style>