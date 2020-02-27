<template>
  <places
    v-model="address.label"
    placeholder="Où allez-vous ?"
    @change="val => {
      this.address.data = val;
      emitGlobalClickEvent(this.address.data)
    }"
    :options="{ address: ['FR'], language: 'fr' }">
  </places>

  <!--
  <places
    class="places"
    :value="value"
    @change="val => { value = val }"
    :options="{ countries: ['FR'], language: 'fr' }"
    v-on:keydown.enter="sendMessageToParent"
  >
  </places>
  -->
</template>

<script>
  import Places from 'vue-places'
  import { EventBus } from "./event-bus.js";

  export default {
    /*props: {
      value: {
        type: String,
        default: ''
      }
    },*/
    data() {
      return {
        address: {
          data: {
            lat: '',
            lng: ''
          },
        },
      };
    },
    components: {
      Places
    },
    methods: {
      emitGlobalClickEvent(address) {
        if(address !== undefined) {
          EventBus.$emit('addressFilled', this.address.data);
        }
      }
    }
  }
</script>

<!--
<div id="map-example-container"></div>
<input type="search" id="input-map" class="form-control" placeholder="Where are we going?" />

<style>
  #map-example-container {height: 300px};
</style>

<script src="https://cdn.jsdelivr.net/npm/places.js@1.18.1"></script>
<script>
  (function() {
    var placesAutocomplete = places({
      appId: '<YOUR_PLACES_APP_ID>',
      apiKey: '<YOUR_PLACES_API_KEY>',
      container: document.querySelector('#input-map')
    });

    var map = L.map('map-example-container', {
      scrollWheelZoom: false,
      zoomControl: false
    });

    var osmLayer = new L.TileLayer(
      'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        minZoom: 1,
        maxZoom: 13,
        attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'
      }
    );

    var markers = [];

    map.setView(new L.LatLng(0, 0), 1);
    map.addLayer(osmLayer);

    placesAutocomplete.on('suggestions', handleOnSuggestions);
    placesAutocomplete.on('cursorchanged', handleOnCursorchanged);
    placesAutocomplete.on('change', handleOnChange);
    placesAutocomplete.on('clear', handleOnClear);

    function handleOnSuggestions(e) {
      markers.forEach(removeMarker);
      markers = [];

      if (e.suggestions.length === 0) {
        map.setView(new L.LatLng(0, 0), 1);
        return;
      }

      e.suggestions.forEach(addMarker);
      findBestZoom();
    }

    function handleOnChange(e) {
      markers
        .forEach(function(marker, markerIndex) {
          if (markerIndex === e.suggestionIndex) {
            markers = [marker];
            marker.setOpacity(1);
            findBestZoom();
          } else {
            removeMarker(marker);
          }
        });
    }

    function handleOnClear() {
      map.setView(new L.LatLng(0, 0), 1);
      markers.forEach(removeMarker);
    }

    function handleOnCursorchanged(e) {
      markers
        .forEach(function(marker, markerIndex) {
          if (markerIndex === e.suggestionIndex) {
            marker.setOpacity(1);
            marker.setZIndexOffset(1000);
          } else {
            marker.setZIndexOffset(0);
            marker.setOpacity(0.5);
          }
        });
    }

    function addMarker(suggestion) {
      var marker = L.marker(suggestion.latlng, {opacity: .4});
      marker.addTo(map);
      markers.push(marker);
    }

    function removeMarker(marker) {
      map.removeLayer(marker);
    }

    function findBestZoom() {
      var featureGroup = L.featureGroup(markers);
      map.fitBounds(featureGroup.getBounds().pad(0.5), {animate: false});
    }
  })();
</script>
-->


<!--<template>
  <places
    v-model="form.country.label"
    placeholder="Où allez-vous ?"
    @change="val => { form.country.data = val }"
    :options="{ countries: ['FR'], language: 'fr' }">
  </places>
</template>

<script>
  import Places from 'vue-places'

  export default {
    data() {
      return {
        form: {
          country: {
            label: null,
            data: {},
          },
        },
      };
    },
    components: {
      Places
    },
    methods: {
      get
    }
  }
</script>
-->
