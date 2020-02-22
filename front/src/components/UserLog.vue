<template>
  <div>
    <b-form class= "my-3" inline @submit="onLogIn">
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
        v-model="logIn.password"
        placeholder="Password"
      ></b-input>

      <b-button class="mr-2" type="submit" variant="primary">Log-in</b-button>
      <b-button class="mr-2" variant="secondary" @click="$bvToast.show('signin-toast')">Sign-in</b-button>

      <b-toast id="signin-toast" title="Registration" no-auto-hide>
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
            v-model="signIn.password"
            placeholder="Password"
          ></b-input>
          <b-button type="submit" variant="primary">Create Account</b-button>
        </b-form>
      </b-toast>
    </b-form>
  </div>
</template>

<script>
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
      }
    }
  },
  methods: {
    onLogIn(evt) {
      evt.preventDefault()

      // JSON.stringify(this.logIn) => send to back end
    },
    onSignIn(evt) {
      evt.preventDefault()

      // JSON.stringify(this.signIn) => send to back end
    }
  }
}
</script>