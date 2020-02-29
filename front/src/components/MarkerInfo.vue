<template>
    <div class="marker-info-layout">
        <p class="adr">Adress : {{adr | capitalize }}</p> 
        <div> Status : 
            <b-badge v-if="status" class="statut" variant="success">Disponible</b-badge>        
            <b-badge v-else class="statut" variant="danger">Indisponible</b-badge>        
        </div>
        <p >Tarif : {{tarif}} </p>
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
      tarif: null,
    };
  },

  filters: {
    capitalize: function (value) {
        if (!value) return '';
        value = value.toString()
        return value.charAt(0).toUpperCase() + value.slice(1)
    }
  },

  created() {
    EventBus.$on('markerClicked', markerInfo => {
      if(markerInfo !== undefined){
        console.log(markerInfo._arrond)
        let codePostal = markerInfo._arrond > 9 ? ", 75 0" + markerInfo._arrond : ", 75 00" + markerInfo._arrond
        this.adr  = markerInfo._typeVoie.toLowerCase()  + " " + markerInfo._nomVoie.toLowerCase() + codePostal + " Paris";
        this.status = markerInfo._statut != "" || null || undefined;
        this.tarif = markerInfo._tarif;
      }
    });
  }
}
</script>
