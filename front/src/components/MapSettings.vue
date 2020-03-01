<template>
  <places
    v-model="address.label"
    placeholder="Où allez-vous ?"
    @change="val => {
      this.address.data = val;
      handleOnChange(this.address.data)
    }"
    :options="{ country: ['FR'], language: 'fr' }">
  </places>

</template>

<script>
  import Places from 'vue-places'
  import { EventBus } from "./event-bus.js";

  export default {

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
      handleOnChange(address) {
        if(address.latlng !== undefined) {
          EventBus.$emit('addressFilled', this.address.data);
        } else {
          this.handleOnClear()
        }
      },

      handleOnClear(){
        EventBus.$emit('addressEmpty')
      }
    }
  }
</script>
