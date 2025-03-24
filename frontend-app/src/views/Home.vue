<template>
  <div class="min-h-screen">
    <section class="pt-20 px-4 pb-8">
      <div class="container mx-auto max-w-6xl">
        <div class="text-center mb-12">
          <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold text-stone-800 mb-6 font-cinzel drop-shadow-lg">
            Bienvenido a la prueba técnica de
            <span class="text-stone-600 block mt-2">Santiago Ramírez</span>
          </h1>
          <p class="text-lg md:text-xl text-stone-700 max-w-2xl mx-auto font-fauna italic">
            Una aplicación full-stack construida con PHP y Vue.js
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
          <div class="feature-card">
            <div class="text-stone-600 mb-4">
              <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4" />
              </svg>
            </div>
            <h3 class="text-xl font-semibold mb-4 text-stone-800 font-cinzel">Backend Development</h3>
            <ul class="space-y-3 text-stone-700 font-fauna">
              <li class="flex items-start">
                <svg class="w-5 h-5 text-stone-600 mr-2 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
                </svg>
                <span>PHP puro con Arquitectura MVC</span>
              </li>
              <li class="flex items-start">
                <svg class="w-5 h-5 text-stone-600 mr-2 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
                </svg>
                <span>Implementación del Principio SRP</span>
              </li>
              <li class="flex items-start">
                <svg class="w-5 h-5 text-stone-600 mr-2 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
                </svg>
                <span>Creación de APIs</span>
              </li>
            </ul>
          </div>

          <div class="feature-card">
            <div class="text-stone-600 mb-4">
              <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
              </svg>
            </div>
            <h3 class="text-xl font-semibold mb-4 text-stone-800 font-cinzel">Frontend Development</h3>
            <ul class="space-y-3 text-stone-700 font-fauna">
              <li class="flex items-start">
                <svg class="w-5 h-5 text-stone-600 mr-2 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
                </svg>
                <span>Vue.js 3 con Composition API</span>
              </li>
              <li class="flex items-start">
                <svg class="w-5 h-5 text-stone-600 mr-2 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
                </svg>
                <span>Diseño Responsive con Tailwind CSS</span>
              </li>
              <li class="flex items-start">
                <svg class="w-5 h-5 text-stone-600 mr-2 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
                </svg>
                <span>Experiencia de Usuario Intuitiva</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: 'Home'
}
</script>

<style scoped>
.feature-card {
  @apply bg-stone-100 bg-opacity-80 p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-200 border-2 border-stone-400 border-opacity-60;
  background-image: url('/paper-texture.jpg');
  background-blend-mode: overlay;
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2), 0 4px 6px -2px rgba(0, 0, 0, 0.1);
}
</style> 