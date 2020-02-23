<template>
  <b-container class="map-container">
    <b-jumbotron>
      <b-row>
        <!--<img src="../assets/map.jpg" height="500" width="700" class="mr-5">-->
        <MapSettings/>
      </b-row>
      <br>
      <b-row>
        <MapBox/>
      </b-row>
    </b-jumbotron>
  </b-container>
</template>

<script>
import MapSettings from './MapSettings.vue'
import MapBox from './MapBox.vue'

export default {
  name: 'Map',
  components: {
    MapSettings,
    MapBox
  }
}
</script>

<style scoped>
  .map-container {
    margin-top: 20px
  }
</style>
