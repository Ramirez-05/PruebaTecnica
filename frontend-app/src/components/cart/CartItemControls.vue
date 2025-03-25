<template>
  <div class="flex items-center space-x-2">
    <button 
      @click="onDecrement" 
      class="bg-stone-200 hover:bg-stone-300 text-stone-800 w-8 h-8 rounded-md flex items-center justify-center">
      <span class="text-lg">-</span>
    </button>
    
    <span class="font-fauna text-stone-800">{{ quantity }}</span>
    
    <button 
      @click="onIncrement"
      :disabled="quantity >= maxQuantity"
      :class="[
        'w-8 h-8 rounded-md flex items-center justify-center',
        quantity >= maxQuantity
          ? 'bg-stone-300 text-stone-500 cursor-not-allowed'
          : 'bg-stone-700 hover:bg-stone-800 text-white'
      ]">
      <span class="text-lg">+</span>
    </button>
  </div>
</template>

<script setup>
defineProps({
  quantity: {
    type: Number,
    required: true
  },
  maxQuantity: {
    type: Number,
    required: true
  }
});

const emit = defineEmits(['increment', 'decrement']);

const onIncrement = () => emit('increment');
const onDecrement = () => emit('decrement');
</script> 