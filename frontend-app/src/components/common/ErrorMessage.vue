<template>
  <div class="max-w-2xl mx-auto bg-red-100 border-2 border-red-400 p-6 rounded-lg text-center">
    <p class="text-red-700 font-fauna">{{ message }}</p>
    <button 
      @click="$emit('retry')" 
      class="mt-4 px-4 py-2 bg-stone-700 text-white rounded-md font-fauna hover:bg-stone-800"
    >
      Reintentar
    </button>
  </div>
</template>

<script>
export default {
  name: 'ErrorMessage',
  props: {
    message: {
      type: String,
      required: true
    }
  },
  emits: ['retry']
}
</script> 