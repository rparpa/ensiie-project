<template>
  <b-container class="map-container">
    <b-jumbotron>
      <b-row>
        <!--<img src="../assets/map.jpg" height="500" width="700" class="mr-5">-->
        <MapSettings
          v-on:change="showAddress($event)"
        ></MapSettings>
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
  },
  data () {
    return {
      form: {
        data: ''
      }
    }
  },
  methods: {
    showAddress (adr) {
      const trimmedAddress = adr.trim();
      console.log("Adresse à afficher: ", adr);
      if (trimmedAddress) {
        this.MapBox.setCenter(trimmedAddress);
      }
    }
  }
}
</script>

<style scoped>
  .map-container {
    margin-top: 20px
  }
</style>
