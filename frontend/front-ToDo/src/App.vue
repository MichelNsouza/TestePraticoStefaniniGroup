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

  <main class="content"> 
    <router-view />
  </main>

  <FooterComponent />

</template>

<style>
html {
  scroll-behavior: smooth;
}


.content {
  min-height: calc(100vh - 100px);
}
</style>