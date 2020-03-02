<template>
  <div>
    <b-nav tabs>
      <b-nav-item disabled><b>Park Ton Char Logo</b></b-nav-item>
      <UserLog class="ml-auto"/>
      <div class="admin"><b-button variant="warning">Admin</b-button></div>
    </b-nav>
  </div>

</template>

<style>
.admin{
  display: flex;
  align-content: center;
  padding: 15px;
}

</style>

<script>
import UserLog from './UserLog'

export default {
  components: {
    UserLog
  }
}
</script>