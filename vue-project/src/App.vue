<template>
  <div id="app">
    <!-- Header hanya tampil jika bukan layout auth -->
    <AppHeader v-if="!isAuthLayout" />
    
    <main class="main-content">
      <router-view />
    </main>
    
    <!-- Footer hanya tampil jika bukan layout auth -->
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
      // Periksa apakah meta layout di route adalah 'auth'
      return this.$route.meta.layout === 'auth'
    }
  }
}
</script>
