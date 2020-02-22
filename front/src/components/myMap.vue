<template>
  <div class="test">
      <MglMap :accessToken="accessToken" :mapStyle="mapStyle" >
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
const axios = require('axios');

export default {
  components: {
    MglMap,
    MglMarker
  },
  data() {
    return {
      accessToken: "pk.eyJ1IjoiZGV2c3Bpbm96YSIsImEiOiJjazZ2enV4aW0wNnd2M2ZwNzU3NXFvc2c5In0.c4mfJ5n3hsVYXURtgRPUyQ", // your access token. Needed if you using Mapbox maps
      mapStyle: "mapbox://styles/mapbox/light-v10",
      listCoordinates: [],
      apiAdr : "http://localhost:5001/"
    };
  },

  mounted() {
      axios.get(this.apiAdr).then(response => (console.log(response)))
  },

  methods: {
    created() {
      this.mapbox = Mapbox;
    }
  }
  };
</script>