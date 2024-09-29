<script>
import FooterComponent from '@/components/FooterComponent.vue';
import HeaderComponent from '@/components/HeaderComponent.vue';

export default {
  components: {
    HeaderComponent,
    FooterComponent,
  },
  data() {
    return {
    };
  },
}
</script>

<template>

  <HeaderComponent />

  <main class="main pt-3 bg-dark-subtle"> 
    <router-view />
  </main>

  <FooterComponent />

</template>

<style>
html {
  scroll-behavior: smooth;
  min-height: 100vh;
}
main{
  min-height: 100vh;
}
</style>