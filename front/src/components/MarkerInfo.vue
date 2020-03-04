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
            <p class="adr">Adresse : {{ this.adr = (this.info._typeVoie ? this.info._typeVoie.toLowerCase() : " N/A ") + " " + (this.info._nomVoie ? this.info._nomVoie.toLowerCase() : "N/A") + ", arrondissement n°" + this.info._arrond +" de Paris" | capitalize }}</p>
            <div> Status :
                <b-badge v-if="info._statut != '' || null || undefined" class="statut" variant="success">Disponible</b-badge>
                <b-badge v-else class="statut" variant="danger">Indisponible</b-badge>
            </div>
            <p class="tarif">Tarif : {{info._tarif}} </p>
            <b-button variant="success" @click="onAlert">Je réserve</b-button>
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
import { EventBus } from "../event-bus.js";

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
    },

    onAlert() {
        alert('Feature à venir ! ');
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
