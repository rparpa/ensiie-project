<template>
  <div class="test">
      <MglMap
        :accessToken="accessToken"
        :mapStyle.sync="mapStyle"
        :center="center"
        :zoom="zoom"
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
      center: [2.349014, 48.864716],
      zoom: 11
    };
  },

  created() {
    //this.mapbox = Mapbox;

    EventBus.$on('addressFilled', address => {
      if(address.latlng !== undefined){
        //console.log("MapBox: Evenement bien recu!", address);
        this.onAddressFilled(address);
      }
    });
    EventBus.$on('addressEmpty', handleOnClear => {
      console.log("Evenement clear recu");
      this.onEmptyAddress();
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

    getCoordinatesFromAddress(address) {
      let coordinates = [];
      if (address !== undefined && address.latlng.lng && address.latlng.lat){
        coordinates = [address.latlng.lng, address.latlng.lat];
      }
      return coordinates;
    },

    centerMapOn(coordinates, zoom) {
      this.mapbox.flyTo({
        center: coordinates,
        zoom: zoom,
        speed: 1
      })
    },

    onAddressFilled(address) {
      let coords = this.getCoordinatesFromAddress(address);
      this.centerMapOn(coords, 17);
    },

    onEmptyAddress() {
      this.centerMapOn(this.center, 11);
    },

    emitMarkerInfo(markerInfo) {
      EventBus.$emit('setMarkerInfo',markerInfo);
    }
  }
};
</script>
