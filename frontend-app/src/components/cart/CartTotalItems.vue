<template>
  <div class="mt-4 mb-4 p-3 bg-stone-100 rounded-md border border-stone-300">
    <div class="flex justify-between items-center">
      <p class="font-fauna text-stone-800">Total productos:</p>
      <p class="font-bold text-stone-800">{{ total }}</p>
    </div>
  </div>
</template>

<script setup>
defineProps({
  total: {
    type: Number,
    required: true
  }
});
</script> 