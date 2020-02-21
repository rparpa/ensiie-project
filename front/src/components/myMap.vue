<template>
  <div class="test">
      <MglMap :accessToken="accessToken" :mapStyle="mapStyle"  @map-load="addMarkers">
        <div v-if="listCoordinates">
           <MglMarker v-for="coordinates in listCoordinates" :key="coordinates" :coordinates="coordinates" color="blue"/>     
        </div>        
      </MglMap>      
  </div>  
</template>

<style>
  .test{
    width: 100%;
    height: 500px;
  }
</style>

<script>
import Mapbox from "mapbox-gl";
import { MglMap,MglMarker } from "vue-mapbox";

export default {
  components: {
    MglMap,
    MglMarker
  },
  data() {
    return {
      accessToken: "pk.eyJ1IjoiZGV2c3Bpbm96YSIsImEiOiJjazZ2enV4aW0wNnd2M2ZwNzU3NXFvc2c5In0.c4mfJ5n3hsVYXURtgRPUyQ", // your access token. Needed if you using Mapbox maps
      mapStyle: "mapbox://styles/mapbox/dark-v10",
      listCoordinates: [[-111,39],[49,2],[2.3488,48.8534]]
    };
  },

  methods: {

    created() {
      // We need to set mapbox-gl library here in order to use it in template
      this.mapbox = Mapbox;
    }
  }
  };
</script>