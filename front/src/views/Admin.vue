<template>
  <div>
    <div v-if="this.$root.$data.user !== undefined && this.$root.$data.user.role == 1">
      <Header/>
    <Nav class="navButtons"/>
    <div class="userTable">
    <div class="btn btn-success" v-b-modal.addUserModal>Add User</div>  
    <b-modal id="addUserModal" title="Sign In"  hide-footer>
          <b-form @submit="">
          <label class="sr-only" for="signin-form-username">Username</label>
          <b-input
            id="signin-form-username"
            class="mb-2"
            placeholder="Username"
          ></b-input>

          <label class="sr-only" for="signin-form-email">Email</label>
          <b-input-group class="mb-2" prepend="@">
            <b-input
              id="signin-form-email"
              type="email"
              placeholder="Email"
            ></b-input>
          </b-input-group>

          <label class="sr-only" for="signin-form-password">Password</label>
          <b-input
            id="signin-form-password"
            class="mb-3"
            type="password"
            placeholder="Password"
          ></b-input>           
          <b-button type="submit" variant="primary" >Create Account</b-button>
        </b-form>
      </b-modal>
      <b-modal id="editProfil" title="Edit Profil"  hide-footer>
          <b-form @submit="">
          <label class="sr-only" for="signin-form-username">Username</label>
          <b-input
            id="signin-form-username"
            class="mb-2"
            placeholder="Username"
          ></b-input>

          <label class="sr-only" for="signin-form-email">Email</label>
          <b-input-group class="mb-2" prepend="@">
            <b-input
              id="signin-form-email"
              type="email"
              placeholder="Email"
            ></b-input>
          </b-input-group>

          <label class="sr-only" for="signin-form-password">Password</label>
          <b-input
            id="signin-form-password"
            class="mb-3"
            type="password"
            placeholder="Password"
          ></b-input>           
          <b-button type="submit" variant="primary">Save Changed</b-button>
        </b-form>
      </b-modal>
      <b-modal id="deleteProfile" title="Delete Profile"  hide-footer>
          <p>Are you sure about deleting this profile ?</p>
          <div class="deleteButtons">
            <div class="btn btn-danger">Nooooo !</div>
            <div class="btn btn-success">Yes !  </div>
          </div>          
      </b-modal>
      <b-table striped hover :fields="fields" :items="items"  class="mt-3" >
        <template v-slot:cell(edit)="data">
            <div class="btn btn-warning" v-b-modal.editProfil>Edit</div>
        </template>
        <template v-slot:cell(delete)="data">
            <div class="btn btn-danger" v-b-modal.deleteProfile>Delete</div>
        </template>
    </b-table>
  </div>    
  </div>
  </div>    
</template>

<style>
  .navButtons{
    position: fixed;
    left: 0px;
    top: 20vw;
    z-index: 99;
  }

  .userTable{
    padding-top: 40px; 
    width: 70vw;
    margin: auto;
  }

  .deleteButtons{
    display: flex;
    flex-direction: row;
    align-items: center;    
  }

  .deleteButtons div {
    margin: 5px;    
  }
</style>

<script>
// @ is an alias to /src
import Header from '@/components/Header.vue'
import Nav from '@/components/Navigation.vue'
import Router from '../router/index';
import axios from "axios";
import {EventBus} from '../event-bus';

export default {
  name: 'Admin',
  components: {
    Header,
    Nav
  },

  mounted() {
    axios.get('http://localhost:3000/users').then(response => {( this.items = response.data);})
    EventBus.$on('deconected', () => {
      Router.push('/')
    });
  },

  data() {
      return {
        fields: [
          '_username',

          '_email',

          '_role',
          // A regular column
          'edit',
          // A regular column
          'delete',
        ],
        items: []
      }
    }
}
</script>
