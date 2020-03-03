<template>
  <div>
    <b-nav tabs>
      <b-nav-item disabled><b>Park Ton Char Logo</b></b-nav-item>
      <UserLog class="ml-auto"/>      
    </b-nav>
  </div>
</template>

<script>
import UserLog from './UserLog'

export default {
  components: {
    UserLog
  }
}
</script>