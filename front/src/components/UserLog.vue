<template>
  <div class="logvue">
    <b-form class= "my-3" inline @submit="onLogIn" v-if="this.$root.$data.user === undefined">
      <label class="sr-only" for="login-form-username">Username</label>
      <b-input
        id="login-form-username"
        class="mr-2"
        v-model="logIn.username"
        placeholder="Username"
      ></b-input>

      <label class="sr-only" for="login-form-password">Password</label>
      <b-input
        id="login-form-password"
        class="mr-3"
        type="password"
        v-model="clearLogInPasswordHolder"
        placeholder="Password"
      ></b-input>
      <b-button class="mr-2" type="submit" variant="primary">Log-in</b-button>
      <div>
        <!-- Using modifiers -->
        <b-button v-b-modal.signInModal @submit="onSignIn">Sign In</b-button>
        <!-- The modal -->
        <b-modal id="signInModal" title="Sign In" hide-footer>
            <b-form @submit="onSignIn">
            <label class="sr-only" for="signin-form-username">Username</label>
            <b-input
              id="signin-form-username"
              class="mb-2"
              v-model="signIn.username"
              placeholder="Username"
            ></b-input>

            <label class="sr-only" for="signin-form-email">Email</label>
            <b-input-group class="mb-2" prepend="@">
              <b-input
                id="signin-form-email"
                type="email"
                v-model="signIn.email"
                placeholder="Email"
              ></b-input>
            </b-input-group>

            <label class="sr-only" for="signin-form-password">Password</label>
            <b-input
              id="signin-form-password"
              class="mb-3"
              type="password"
              v-model="clearSignInPasswordHolder"
              placeholder="Password"
            ></b-input>           
            <b-button type="submit" variant="primary" >Create Account</b-button>
          </b-form>
        </b-modal>
      </div>
    </b-form>
    <b-collapse id="errorMessageCollapsible" v-model="displayAuthenticationErrorAlert">
      <b-alert variant="warning" show>
        Username or password incorrect!
      </b-alert>
    </b-collapse>
    <div class= "my-1" id="userLoggedInContainer" v-if="this.$root.$data.user != undefined">
      <p>
        Bienvenue, {{this.$root.$data.user._username}} !
      </p>
      <b-row>
        <b-button class= "mr-2" v-b-modal.settingsModel @submit="onUpdateSettings">Paramètres</b-button>
        <b-modal id="settingsModel" title="Paramètres" hide-footer>
            <b-form @submit="onUpdateSettings">
            <label class="sr-only" for="settings-form-username">Username</label>
            <b-input
              id="settings-form-username"
              class="mb-2"
              placeholder="Username"
              v-model= "settings.username"
            ></b-input>    
            <label class="sr-only" for="settings-form-email">Email</label>
            <b-input
              id="settings-form-email"
              class="mb-2"
              placeholder="Email"
              v-model= "settings.email"
            ></b-input>   
            <label class="sr-only" for="settings-form-pwd">Password</label>
            <b-input
              id="settings-form-pwd"
              class="mb-2"
              placeholder="New Password"
              v-model="clearSettingsPasswordHolder"
            ></b-input>  
            <b-button type="submit" variant="primary">Mettre a jour</b-button>
          </b-form>
        </b-modal>
        <b-button variant="danger" @click="onDeconnection">Déconnexion</b-button>
      </b-row>
    </div>
  </div>
</template>

<style>

.logvue {
 padding-right: 20px;
}
</style>

<script>
import {HTTP} from '../http-constants'
import User from '../entity/User'
import { EventBus } from '../event-bus';
const sha256 = require('js-sha256');

export default {
  data() {
    return {
      logIn: {
        username: '',
        password: ''
      },
      signIn: {
        username: '',
        email: '',
        password: '',
        role: 0
      },
      settings: {
        username: '',
        email: '',
        password: ''
      },
      currentUser: undefined,
      clearLogInPasswordHolder: '',
      clearSignInPasswordHolder: '',
      clearSettingsPasswordHolder: '',
      displayAuthenticationErrorAlert: false
    }
  },
  watch: {
    clearLogInPasswordHolder: function(value) {
      sha256(value);
      let hash = sha256.create();
      hash.update(value);

      this.logIn.password = hash.hex();
    },
    clearSignInPasswordHolder: function(value) {
      sha256(value);
      let hash = sha256.create();
      hash.update(value);

      this.signIn.password = hash.hex();
    },
    clearSettingsPasswordHolder: function(value) {
      sha256(value);
      let hash = sha256.create();
      hash.update(value);

      this.settings.password = hash.hex();
      console.log(this.settings.password)
    }
  },
  methods: {
    onLogIn(evt) {
      evt.preventDefault();
      HTTP.post('authentication'
      , this.logIn
      )
      .then(response => {
        this.displayAuthenticationErrorAlert = false
        this.currentUser = new User(response.data.username, response.data.encryptedPassword, response.data.email)
        this.settings.username = this.currentUser.username
        this.settings.email = this.currentUser.email
        this.$root.$data.user = this.currentUser;
      })
      .catch(error => {      
        this.displayAuthenticationErrorAlert = true
        console.log(error);
      })
    },
    onSignIn(evt) {
      evt.preventDefault()      
      HTTP.post('registration'
      , this.signIn
      )
      .then(response => {
        this.currentUser = new User(response.data.username, response.data.encryptedPassword, response.data.email);
        this.$root.$data.user = this.currentUser;
      })
      .catch(error => {      
        console.log(error);
      })
    },
    onUpdateSettings(evt) {
      evt.preventDefault()

      const postObject = {
        currentUsername: this.currentUser.username,
        newUsername: this.settings.username,
        newEmail: this.settings.email,
        newPassword: this.settings.password === '' ? this.currentUser.encryptedPassword : this.settings.password
      }

      HTTP.post('updateUser'
      , postObject)
      .then(this.currentUser = new User(postObject.newUsername, postObject.newPassword, postObject.newEmail))
      .catch(error => {      
        console.log(error);
      })
    },

    onDeconnection(){
      this.currentUser =undefined;
      this.$root.$data.user = undefined;
      EventBus.$emit('deconected');
    }
  }
}
</script>