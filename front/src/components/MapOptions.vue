<template>
  <div>
    <b-row>
      <b-col>
        <b-form-select v-model="typVehicSelected" :options="optionsTypeVehicule" @change="emitVehicleChanged" ></b-form-select>
      </b-col>
      <b-col>
        <b-form-select v-model="typStaSelected" :options="optionsTypsta"></b-form-select>
      </b-col>
    </b-row>
  </div>
</template>

<script>
  import { EventBus } from "./event-bus.js";
  export default {
    name: "MapOptions",
    data() {
        return {
          typVehicSelected: null,
          optionsTypeVehicule: [
            { value: null, text: 'Quel type de véhicule souhaitez-vous garer?'},
            { value: 'voiture', text: 'Voiture'},
            { value: 'deux-roues', text: '2 roues'},
            { value: 'bus', text: 'Bus'},
            { value: 'electrique', text: 'Véhicule électrique'},
            { value: 'velo', text: 'Vélo'}
          ],

          typStaSelected: null,
          optionsTypsta: [
            { value: null, text: 'Avez-vous un type de stationnement favori?'},
            { value: 'longitudinal', text: 'Longitudinal'},
            { value: 'epi', text: 'Epi'},
            { value: 'bataille', text: 'Bataille'}
          ]
        }
    },
    methods: {
      emitVehicleChanged(){
        console.log('changed')
        EventBus.$emit('vehicleChanged', this.typVehicSelected);
      }
    }
  }
</script>

<style scoped>

</style>
