<template>
  <div class="flex justify-center py-10">
    <div class="text-center">
      <p class="text-xl text-stone-700 font-fauna mb-4">{{ message }}</p>
      <div class="w-16 h-16 border-4 border-stone-600 border-t-transparent rounded-full animate-spin mx-auto"></div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'LoadingSpinner',
  props: {
    message: {
      type: String,
      default: 'Cargando...'
    }
  }
}
</script> 