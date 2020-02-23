<template>
  <div class="test">
      <MglMap :accessToken="accessToken" :mapStyle="mapStyle" >
        <div v-if="listCoordinates">
           <MglMarker class="points" v-for="coordinates in listCoordinates" :key="coordinates[0]*coordinates[1]" :coordinates="coordinates" color="green"/>     
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
import  axios from "axios";

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
      apiAdr : "http://localhost:5001/bigQuery"
    };
  },

  mounted() {
    this.getAllMarkers();  
  },

  methods: {
    created() {
      this.mapbox = Mapbox;
    },

    getAllMarkers(){
      axios.get(this.apiAdr).then(response => ( this.listCoordinates = response.data.map(x => [x.coords.long,x.coords.lat])))
    }
  }
  };
</script>