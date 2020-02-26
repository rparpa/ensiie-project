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
import {EventBus} from "./event-bus";

EventBus.$on('addressFilled', address => {
  console.log("Evenement bien recu!");
  this.onAdressFilled(addressFilled);
});

export default {
  name: 'MapBox',
  components: {
    MglMap,
    MglMarker
  },
  props: ['address'],
  data: function() {
    return {
      accessToken: "pk.eyJ1IjoiZGV2c3Bpbm96YSIsImEiOiJjazZ2enV4aW0wNnd2M2ZwNzU3NXFvc2c5In0.c4mfJ5n3hsVYXURtgRPUyQ", // your access token. Needed if you using Mapbox maps
      mapStyle: "mapbox://styles/mapbox/light-v10",
      listCoordinates: [],
      apiAdr : "http://localhost:3000/openDataParis/getAllParkingSpots",
      center: [48.864716, 2.349014],
      zoom: 12
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
      axios.get(this.apiAdr).then(response => ( this.listCoordinates = response.data.map(x => [x._longitude,x._latitude])))
    },

    onAdressFilled(address) {
      console.log("Adresse recue ", address);
    }
  }
  };
</script>
