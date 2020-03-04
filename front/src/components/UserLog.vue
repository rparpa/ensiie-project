<template>
  <div class="logvue">
    <b-form class= "my-3" inline @submit.stop.prevent="onLogIn" v-if="this.$root.$data.user===undefined">
      <b-form-group id="signin-form-group-username">
        <b-form-input
          id="login-form-input-username"
          placeholder="Username"
          class="mr-2"
          v-model="logIn.username"
        ></b-form-input>
      </b-form-group>

      <label class="sr-only" for="login-form-password">Password</label>
      <b-input
        id="login-form-password"
        class="mr-3"
        type="password"
        v-model="clearPasswords.clearLogInPasswordHolder"
        placeholder="Password"
      ></b-input>
      <b-button class="mr-2" type="submit" variant="primary">Connexion</b-button>
      <div>
        <!-- Using modifiers -->
        <b-button v-b-modal.signInModal @submit="onSignIn">Inscription</b-button>
        <!-- The modal -->
        <b-modal id="signInModal" title="Inscription" @hidden="onHideSignInModal" hide-footer>
            <b-form @submit.stop.prevent="onSignIn">
              <b-alert v-model="signInErrorAlert" variant="danger">
                Nom d'utilisateur ou adresse email déjà utlisée.
              </b-alert>
              <b-form-group id="signin-form-group-username">
                <b-form-input
                  id="signin-form-input-username"
                  placeholder="Nom d'utilisateur"
                  class="mb-2"
                  v-model="$v.signIn.username.$model"
                  :state="validateSignInState('username')"
                  aria-describedby="signin-username-live-feedback"
                ></b-form-input>

                <b-form-invalid-feedback
                  id="signin-username-live-feedback"
                  >Ce champ doit comporter au moins 5 caractères.
                </b-form-invalid-feedback>
              </b-form-group>

            <label class="sr-only" for="signin-form-email">Email</label>
            <b-input-group class="mb-2" prepend="@">
              <b-input
                id="signin-form-email"
                type="email"
                v-model="signIn.email"
                placeholder="Email"
              ></b-input>
            </b-input-group>

            <b-form-group id="signin-form-group-password">
              <b-form-input
                id="signin-form-input-password"
                placeholder="Mot de passe"
                class="mb-3"
                type="password"
                v-model="$v.clearPasswords.clearSignInPasswordHolder.$model"
                :state="validateClearPasswordState('clearSignInPasswordHolder')"
                aria-describedby="signin-password-live-feedback"
              ></b-form-input>           

              <b-form-invalid-feedback
                id="signin-password-live-feedback"
                >Ce champ doit comporter au moins 6 caractères.
              </b-form-invalid-feedback>
            </b-form-group>
            <b-button type="submit" variant="primary">Créer un compte</b-button>
          </b-form>
        </b-modal>
      </div>
    </b-form>
    <b-collapse id="errorMessageCollapsible" v-model="displayAuthenticationErrorAlert">
      <b-alert variant="warning" show>
        Nom d'utilisateur ou mot de passe incorrect !
      </b-alert>
    </b-collapse>
    <div class= "my-1" id="userLoggedInContainer" v-if="this.$root.$data.user != undefined">
      <p>
        Bienvenue, {{this.$root.$data.user._username}} !
      </p>
      <b-row>
        <b-button class= "mr-2" v-b-modal.settingsModel @submit="onUpdateSettings">Paramètres</b-button>
        <b-modal id="settingsModel" title="Paramètres" @hidden="onHideSettingsModal" hide-footer>
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
              v-model="clearPasswords.clearSettingsPasswordHolder"
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

import { validationMixin } from "vuelidate";
import { required, minLength } from "vuelidate/lib/validators";

import { EventBus } from '../event-bus';

const sha256 = require('js-sha256');

export default {
  mixins: [validationMixin],
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
      clearPasswords: {
        clearLogInPasswordHolder: null,
        clearSignInPasswordHolder: null,
        clearSettingsPasswordHolder: null,
      },
      displayAuthenticationErrorAlert: false,
      signInErrorAlert: false
    }
  },
  validations: {
    signIn: {
      username: {
        required,
        minLength: minLength(5)
      }
    },
    clearPasswords: {
      clearSignInPasswordHolder: {
        required,
        minLength: minLength(6)
      }
    }
  },
  watch: {
    'clearPasswords.clearLogInPasswordHolder': function(value) {
      sha256(value);
      let hash = sha256.create();
      hash.update(value); 

      this.logIn.password = hash.hex();
    },
    'clearPasswords.clearSignInPasswordHolder': function(value) {
      sha256(value);
      let hash = sha256.create();
      hash.update(value);

      this.signIn.password = hash.hex();
    },
    'clearPasswords.clearSettingsPasswordHolder': function(value) {
      sha256(value);
      let hash = sha256.create();
      hash.update(value);

      this.settings.password = hash.hex();
      console.log(this.settings.password)
    }
  },
  methods: {
    validateSignInState(name) {
      const { $dirty, $error } = this.$v.signIn[name];
      return $dirty ? !$error : null;
    },
    validateClearPasswordState(name) {
      const { $dirty, $error } = this.$v.clearPasswords[name]
      return $dirty ? !$error : null;
    },
    onLogIn(evt) {
      evt.preventDefault();
      HTTP.post('authentication'
      , this.logIn
      )
      .then(response => {
        this.displayAuthenticationErrorAlert = false;        
        this.currentUser = new User(response.data.username, response.data.encryptedPassword, response.data.email,undefined , undefined, response.data.role)
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
      this.$v.signIn.$touch();
      if (this.$v.signIn.$anyError || this.$v.clearPasswords.$anyError) {
        return;
      } 

      evt.preventDefault()
      
      HTTP.post('registration'
      , this.signIn
      )
      .then(response => {
        this.currentUser = new User(response.data.username, response.data.encryptedPassword, response.data.email, undefined, undefined, response.data.role);)
        this.$root.$data.user = this.currentUser;
        this.signIn.username = '';
        this.signIn.email = '';
        this.settings.username = this.currentUser.username
        this.settings.email = this.currentUser.email
        this.clearPasswords.clearSignInPasswordHolder = '';
        this.signInErrorAlert = false;
      })
      .catch(error => {      
        console.log(error);
        this.signInErrorAlert = true;
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
      .then(
        this.currentUser = new User(postObject.newUsername, postObject.newPassword, postObject.newEmail)
      )
      .catch(error => {      
        console.log(error);
      })
    },
    onHideSignInModal(evt) {
      this.signIn.username = '';
      this.signIn.email = '';
      this.clearPasswords.clearSignInPasswordHolder = '';
      this.signInErrorAlert = false;
    },
    onHideSettingsModal(evt) {
      this.settings.username = this.currentUser.username
      this.settings.email = this.currentUser.email
    },
    onDeconnection(){
      this.logIn.username = '';
      this.logIn.password = '';
      this.currentUser =undefined;
      this.$root.$data.user = undefined;
      EventBus.$emit('deconected');
    }
  }
}
</script>