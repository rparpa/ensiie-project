<template>
  <div class="layout">
    <b-container class="map-container col-8">
      <b-jumbotron>
        <b-row>
          <MapSettings/>
        </b-row>
        <br>
        <b-row>
          <MapBox/>
        </b-row>      
      </b-jumbotron>
  </b-container>
  <b-container class="map-container col-4">
      <b-jumbotron>        
        <b-row>
          <MarkerInfo/>
        </b-row>
      </b-jumbotron>
  </b-container>
  </div>
</template>

<script>
import MapSettings from './MapSettings.vue'
import MarkerInfo from './MarkerInfo.vue'
import MapBox from './MapBox.vue'
import {EventBus} from "./event-bus";

export default {
  name: 'Map',
  components: {
    MapSettings,
    MapBox,
    MarkerInfo
  }
}
</script>

<style scoped>
  .layout{
    display: flex;
    flex-direction: row;
  }

  .map-container {
    margin-top: 20px
  }
</style>
