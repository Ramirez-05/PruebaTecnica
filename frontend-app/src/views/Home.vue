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
          <div class="bg-stone-100 p-6 rounded-lg shadow-md border-2 border-stone-500 h-full">
            <h3 class="text-xl font-semibold mb-4 text-stone-800 font-cinzel">Tecnologías Backend</h3>
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
                <span>Inyección de Dependencias</span>
              </li>
              <li class="flex items-start">
                <svg class="w-5 h-5 text-stone-600 mr-2 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
                </svg>
                <span>Creación de APIs</span>
              </li>
            </ul>
          </div>

          <div class="bg-stone-100 p-6 rounded-lg shadow-md border-2 border-stone-500 h-full">
            <h3 class="text-xl font-semibold mb-4 text-stone-800 font-cinzel">Tecnologías Frontend</h3>
            <ul class="space-y-3 text-stone-700 font-fauna">
              <li class="flex items-start">
                <svg class="w-5 h-5 text-stone-600 mr-2 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
                </svg>
                <span>Vue.js como framework principal de UI</span>
              </li>
              <li class="flex items-start">
                <svg class="w-5 h-5 text-stone-600 mr-2 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
                </svg>
                <span>Pinia para gestión de estado de la aplicación</span>
              </li>
              <li class="flex items-start">
                <svg class="w-5 h-5 text-stone-600 mr-2 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
                </svg>
                <span>Axios para peticiones HTTP y comunicación con la API</span>
              </li>
              <li class="flex items-start">
                <svg class="w-5 h-5 text-stone-600 mr-2 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
                </svg>
                <span>TailwindCSS para estilizado y diseño responsivo</span>
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