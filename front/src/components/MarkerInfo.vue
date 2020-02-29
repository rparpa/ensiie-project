<template>
    <div class="marker-info-layout">
        <p class="adr">Adress : {{adr}}</p>
        <p class="statut">Status : {{status}} </p>
        <p class="Tarif">Tarif : {{tarif}} </p>
    </div>
</template>

<style>
    .marker-info-layout{
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }
</style>

<script>
import { EventBus } from "./event-bus.js";

export default {
  name: 'MarkerInfo',
  components: {
  },

  data: function() {
    return {
      adr: null,
      status: null, 
      tarif: null
    };
  },

  created() {
    EventBus.$on('markerClicked', markerInfo => {
      if(markerInfo !== undefined){
         this.adr  = markerInfo._typeVoie + " " + markerInfo._nomVoie + " 75 0" + markerInfo._arrond + " Paris";
         this.status = markerInfo._statut;
         this.tarif = markerInfo._tarif;
      }
    });
  }
}
</script>
