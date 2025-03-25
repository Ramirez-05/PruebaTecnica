<template>
  <div class="feature-card">
    <h2 class="text-xl font-semibold mb-4 text-stone-800 font-cinzel">Información Personal</h2>
    <div class="space-y-2">
      <p class="text-stone-700 font-fauna">
        <span class="font-semibold">Nombre:</span> {{ userName || 'No disponible' }}
      </p>
      <p class="text-stone-700 font-fauna">
        <span class="font-semibold">Email:</span> {{ userEmail || 'No disponible' }}
      </p>
      <div v-if="userData && Object.keys(userData).length > 0" class="mt-4 space-y-2">
        <p v-for="(value, key) in userData" :key="key" class="text-stone-700 font-fauna">
          <span class="font-semibold">{{ formatKey(key) }}:</span> {{ value }}
        </p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'UserInfoCard',
  props: {
    userName: {
      type: String,
      default: 'No disponible'
    },
    userEmail: {
      type: String,
      default: 'No disponible'
    },
    userId: {
      type: [String, Number],
      default: 'No disponible'
    },
    userData: {
      type: Object,
      default: () => ({})
    },
    formatKey: {
      type: Function,
      required: true
    }
  }
}
</script>

<style scoped>
.feature-card {
  @apply bg-stone-100 bg-opacity-90 p-6 rounded-lg shadow-md border-2 border-stone-500 transition-all duration-300;
  background-image: url('/paper-texture.jpg');
  background-blend-mode: overlay;
}
</style> 