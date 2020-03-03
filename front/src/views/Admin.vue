<template>
  <div>
    <Header/>
    <Nav class="navButtons"/>
    <div class="userTable">
    <div class="btn btn-success">Add User</div>  
      <b-table striped hover :fields="fields" :items="items"  class="mt-3" >
        <template v-slot:cell(edit)="data">
            <div class="btn btn-warning">Edit</div>
        </template>
        <template v-slot:cell(delete)="data">
            <div class="btn btn-danger">Delete</div>
        </template>
    </b-table>
  </div>    
  </div>
</template>

<style>
  .navButtons{
    position: fixed;
    left: 0px;
    top: 20vw;
    z-index: 99999;
  }

  .userTable{
    padding-top: 40px; 
    width: 70vw;
    margin: auto;
  }
</style>

<script>
// @ is an alias to /src
import Header from '@/components/Header.vue'
import Nav from '@/components/Navigation.vue'

export default {
  name: 'Admin',
  components: {
    Header,
    Nav
  },
   data() {
      return {
        fields: [
          'age',

          'first_name',

          'last_name',
          // A regular column
          'edit',
          // A regular column
          'delete',
        ],
        items: [
          { age: 40, first_name: 'Dickerson', last_name: 'Macdonald' },
          { age: 21, first_name: 'Larsen', last_name: 'Shaw' },
          { age: 89, first_name: 'Geneva', last_name: 'Wilson' },
          { age: 38, first_name: 'Jami', last_name: 'Carney' }
        ]
      }
    }
}
</script>
