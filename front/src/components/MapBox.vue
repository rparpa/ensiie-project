<template>
  <div class="test">
      <MglMap
        :accessToken="accessToken"
        :mapStyle.sync="mapStyle"
        @load="onMapLoaded"
      >
        <div v-if="listCoordinates">
           <MglMarker 
            class="points" 
            v-for="coordinates in listCoordinates" 
            :key="coordinates._parkingSpotId" 
            :coordinates="[coordinates._latitude,coordinates._longitude]" 
            color="green" 
            @click="val => {
              emitMarkerInfo(coordinates)
            }" 
          />
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
import { EventBus } from "./event-bus.js";

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

  created() {
    //this.mapbox = Mapbox;

    EventBus.$on('addressFilled', address => {
      if(address){
        //console.log("MapBox: Evenement bien recu!", address);
        this.onAddressFilled(address);
      }
    });
    EventBus.$on('clear', handleOnClear => {
      console.log("Evenement clear recu");
    })
  },

  mounted() {
    this.getAllMarkers();
  },

  methods: {
    onMapLoaded(event) {
      //console.log("event onMapLoaded", event);
      this.mapbox = event.map;
    },

    getAllMarkers(){
      axios.get(this.apiAdr).then(response => ( this.listCoordinates = response.data))
    },

    onAddressFilled(address) {
      if (address !== undefined) {
        this.mapbox.flyTo({
          center: [address.latlng.lng, address.latlng.lat],
          zoom: 17,
          speed: 1
        });
      }
    },

    emitMarkerInfo(markerInfo) {
      EventBus.$emit('setMarkerInfo',markerInfo);
    }
  }
};
</script>
