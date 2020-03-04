<template>
  <div class="test">    
      <div v-if="retrieving" class="clearfix">
        <b-spinner class="float-right" label="Floated Right"></b-spinner>
      </div>
      <br/>
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
import { EventBus } from "../event-bus.js";

let latLngCenterParis = {
  lat: 48.864716,
  lng: 2.349014
};

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
      subRoute : 'getAllParkingSpots',
      routeOption : '',
      apiAdr : "http://localhost:3000/openDataParis/",
      center: latLngCenterParis,
      zoom: 11,
      retrieving : false
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
      this.onEmptyAddress();
    });

    this.subRoute = 'getAllParkingSpots';
    EventBus.$on('vehicleChanged', vehicle => {
      switch (vehicle) {
        case 'voiture':
          this.subRoute = 'getAllParkingSpotsVoitures';
          this.getAllMarkers();
          break;        
        case 'deux-roues':
          this.subRoute = 'getAllParkingSpotsMotos';
          this.getAllMarkers();
          break;
        case 'bus':
          this.subRoute = 'getAllParkingSpotsAutocar';
          this.getAllMarkers();
          break;  
        case 'electrique':
          this.subRoute = 'getAllParkingSpotsElectrique';
          this.getAllMarkers();
          break; 
        case 'velo':
          this.subRoute = 'getAllParkingSpotsVelos';
          this.getAllMarkers();
          break;     
        default:
          this.subRoute = 'getAllParkingSpots';
          this.getAllMarkers();
          break;
      }
    });


     EventBus.$on('staChanged', vehicle => {
      switch (vehicle) {
        case 'longitudinal':
          this.routeOption = '?&refine.typsta=Longitudinal';
          this.getAllMarkers();
          break;        
        case 'epi':
         this.routeOption = '?&refine.typsta=Epi';
          this.getAllMarkers();
          break;
        case 'bataille':
          this.routeOption = '?&refine.typsta=Bataille';
          this.getAllMarkers();
          break;            
        default:
          this.routeOption = '';
          this.getAllMarkers();
          break;
      }
    });
    /* 
       
     
      &refine.typsta=Longitudinal
    */ 
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
      this.listCoordinates = [];
      this.retrieving = true;
      console.log(this.apiAdr + this.subRoute + this.routeOption)
      axios.get(this.apiAdr + this.subRoute + this.routeOption).then(response => {( this.listCoordinates = response.data); this.retrieving = false;})
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
