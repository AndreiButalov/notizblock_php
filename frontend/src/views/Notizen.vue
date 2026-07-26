<template>
  <div class="flex min-h-screen items-center justify-center">
    <div class="flex h-192 w-152 flex-col rounded-xl bg-[#FAEBD7] p-8">
      <h1 class="mb-4 text-2xl font-bold">Hallo</h1>

      <router-link class="mb-6 link" to="/addNotizen">
        Add Notizen
      </router-link>

      <!-- Notizen -->
      <div class="flex-1 overflow-y-auto">
        <div class="grid grid-cols-3 gap-4">
          <div
            v-for="n in 20"
            :key="n"
            class="h-40 rounded-lg bg-amber-900"
          ></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
</script>
