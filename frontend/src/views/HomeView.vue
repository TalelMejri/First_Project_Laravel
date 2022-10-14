<template>
  <div class="home">
      <page_user></page_user>
  </div>
</template>

<script>
// @ is an alias to /src
import page_user from '@/components/user.vue'

export default {
  name: 'HomeView',
  components: {
    page_user
  }
}
</script>
