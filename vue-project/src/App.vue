<template>
  <div id="app">
    <AppHeader v-if="!isAuthLayout" />
    
    <main class="main-content">
      <router-view />
    </main>
    

    <AppFooter v-if="!isAuthLayout" />
  </div>
</template>

<script>
import AppHeader from '@/components/Header.vue'
import AppFooter from '@/components/Footer.vue'

export default {
  name: 'App',
  components: {
    AppHeader,
    AppFooter
  },
  computed: {
    isAuthLayout() {
      
      return this.$route.meta.layout === 'auth'
    }
  }
}
</script>
