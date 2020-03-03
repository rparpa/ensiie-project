<template>
  <div class="logvue">
    <b-form class= "my-3" inline @submit="onLogIn" v-if="currentUser===undefined">
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
    <div class= "my-1" id="userLoggedInContainer" v-if="currentUser">
      <p>
        Bienvenue, {{currentUser.username}} !
      </p>
      <b-row>
        <b-button class= "mr-2">Paramètres</b-button>
        <b-button variant="danger" @click="currentUser = undefined">Déconnexion</b-button>
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
        password: ''
      },
      currentUser: undefined,
      clearLogInPasswordHolder: '',
      clearSignInPasswordHolder: '',
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
        this.currentUser = new User(response.data.username, response.data.encryptedPassword, response.data.email)
        console.log(this.currentUser)
      })
      .catch(error => {      
        console.log(error);
      })
    }
  }
}
</script>