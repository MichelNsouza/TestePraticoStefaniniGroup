<script>
export default {
  props: {
    type: {
      type: String,
      default: 'primary', 
    },
    
    message: {
      type: String,
      required: true, 
    },
  },
};
</script>

<template>
  <div :class="`alert alert-${type}`" role="alert" class="border-dark text-center">
    {{ message }}
  </div>
</template>

<style scoped>
</style>
