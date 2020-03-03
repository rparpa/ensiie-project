<template>
  <div class="layout">
    <b-container class="map-container col">
      <b-jumbotron>
        <b-row>
          <b-col><MapOptions/></b-col>
        </b-row>
        <br>
        <b-row>
          <MapSettings/>
        </b-row>
        <br>
        <b-row>
          <MapBox/>
        </b-row>
      </b-jumbotron>
  </b-container>
  <b-container v-if="markerInfoStatus" class="map-container side-panel col-4">
    <b-row>
      <b-card
          header="Parking Informations"
          header-tag="header"
          footer="🅿️"
          footer-tag="footer"
          style="min-width: 100%;"
          class="infocard mb-2"
        >
        <b-card-text>
          <MarkerInfo v-bind:info="markerInfo"/>
        </b-card-text>
      </b-card>
    </b-row>
  </b-container>
  </div>
</template>

<script>
import MapSettings from './MapSettings.vue'
import MarkerInfo from './MarkerInfo.vue'
import MapBox from './MapBox.vue'
import MapOptions from "./MapOptions";
import {EventBus} from "./event-bus";

export default {
  name: 'Map',
  components: {
    MapSettings,
    MapBox,
    MarkerInfo,
    MapOptions
  },

  mounted() {
    EventBus.$on('setMarkerInfo', markerInfo => {
      this.markerInfoStatus = true;
      this.markerInfo = markerInfo;
    });

    EventBus.$on('closeInfo',(() =>{
      this.markerInfoStatus = false;
    }));
  },

  data : function(){
     return {
       markerInfoStatus : false,
       markerInfo : null
     }
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

  .map-container.side-panel.col-4{
    margin: 20px;
  }

</style>
