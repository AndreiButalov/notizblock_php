<template>
  <div class="flex min-h-screen items-center justify-center">
    <div class="flex h-192 w-152 flex-col rounded-xl bg-[#FAEBD7] p-8">
      <h1 class="mb-4 text-2xl font-bold">Hallo</h1>

      <router-link
        class="mb-6 w-fit rounded-lg bg-amber-300 px-4 py-2 transition hover:bg-amber-400"
        to="/addNotizen"
      >
        + Notiz hinzufügen
      </router-link>

      <div class="flex-1 overflow-y-auto pr-2">
        <div class="grid grid-cols-2 gap-5">
          <div
            v-for="n in 20"
            :key="n"
            class="flex h-64 flex-col rounded-xl border border-gray-300 bg-white p-4 shadow"
          >
            <h2 class="mb-3 truncate text-xl font-bold">Titel der Notiz {{ n }}</h2>

            <div class="mb-3 flex-1 overflow-y-auto wrap-break-word text-sm leading-6 text-gray-700">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores, eaque. Lorem
              ipsum dolor sit amet consectetur adipisicing elit. Voluptates quidem cupiditate
              reprehenderit inventore accusantium molestiae doloremque, illum excepturi recusandae
              quia. Lorem ipsum dolor sit amet consectetur adipisicing elit.
            </div>

            <p class="mb-4 text-xs text-gray-500">26.07.2026</p>

            <div class="mt-auto flex justify-between gap-2">
              <button
                class="btn"
              >
                Bearbeiten
              </button>

              <button
                class="btn"
              >
                Löschen
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup></script>
