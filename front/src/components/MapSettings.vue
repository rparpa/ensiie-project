<template>
  <!-- Champ de recherche -->
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
    }
  }
</script>
