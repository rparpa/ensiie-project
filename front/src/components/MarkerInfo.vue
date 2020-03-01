<template>
    <div class="marker-info-layout">
        <div class="info-control">
            <b-button variant="outline-primary" class="btn-close" @click="val => {
              emitClose()
            }"
            >Close</b-button>
        </div>        
        <div class="info-card" @change="val => {
          emitOpen()
        }">
            <p class="adr">Adress : {{ this.adr = this.info._typeVoie.toLowerCase()  + " " + this.info._nomVoie.toLowerCase() + ", arrondissement n°" + this.info._arrond +" de Paris" | capitalize }}</p> 
            <div> Status : 
                <b-badge v-if="info._statut != '' || null || undefined" class="statut" variant="success">Disponible</b-badge>        
                <b-badge v-else class="statut" variant="danger">Indisponible</b-badge>        
            </div>
            <p class="tarif">Tarif : {{info._tarif}} </p>
        </div>        
    </div>
</template>

<style>
    .info-card{
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .info-control{
        display: flex;
        justify-content: flex-end;
    }

    .marker-info-layout{
        display: flex;        
        flex-direction: column;
        width: 100%;
    }

    .btn-close{
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
    }
</style>

<script>
import { EventBus } from "./event-bus.js";

export default {
  name: 'MarkerInfo',
  components: {
  },

  props: ['info'],

  methods: {
    emitClose() {
        EventBus.$emit('closeInfo');
    },
    emitOpen() {
        EventBus.$emit('openMarkerInfo');
    }
  },

  filters: {
    capitalize: function (value) {
        if (!value) return '';
        value = value.toString()
        return value.charAt(0).toUpperCase() + value.slice(1)
    }
  }
}
</script>
