<template>
  <div class="flex justify-center py-4">
    <div class="animate-spin rounded-full h-10 w-10 border-b-2 border-stone-800"></div>
    <span v-if="message" class="ml-2 text-stone-600">{{ message }}</span>
  </div>
</template>

<script setup>
defineProps({
  message: {
    type: String,
    default: ''
  }
});
</script> 