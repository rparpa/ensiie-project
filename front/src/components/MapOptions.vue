<template>
  <div>
    <b-row>
      <b-col>
        <b-form-select v-model="typVehicSelected" :options="optionsTypeVehicule"></b-form-select>
      </b-col>
      <b-col>
        <b-form-select v-model="typStaSelected" :options="optionsTypsta"></b-form-select>
      </b-col>
    </b-row>
  </div>
</template>

<script>
    export default {
        name: "MapOptions",
      data() {
          return {
            typVehicSelected: null,
            optionsTypeVehicule: [
              { value: null, text: 'Quel type de véhicule souhaitez-vous garer?'},
              { value: 'voiture', text: 'Voiture'},
              { value: 'deux-roues', text: '2 roues'}
            ],

            typStaSelected: null,
            optionsTypsta: [
              { value: null, text: 'Avez-vous un type de stationnement favori?'},
              { value: 'longitudinal', text: 'Longitudinal'},
              { value: 'epi', text: 'Epi'},
              { value: 'bataille', text: 'Bataille'}
            ]
          }
      }
    }
</script>

<style scoped>

</style>
