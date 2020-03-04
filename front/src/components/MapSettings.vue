<template>
  <places
    v-model="address.label"
    placeholder="Où allez-vous ?"
    @change="val => {
      this.address.data = val;
      handleOnChange()
    }"
    :options="{ countries: ['fr'], language: 'fr' }"
  >
  </places>  
</template>

<script>
  import Places from 'vue-places'
  import { EventBus } from "../event-bus";

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
      handleOnChange() {
        if(this.address.data.latlng !== undefined) {
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
