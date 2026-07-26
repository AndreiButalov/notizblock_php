<template>
  <div class="flex min-h-screen items-center justify-center">
    <div class="flex h-192 w-152 flex-col rounded-xl bg-[#FAEBD7] p-8">
      <h1 class="mb-4 text-2xl font-bold">Notizen:</h1>

      <router-link
        class="mb-6 w-fit rounded-lg bg-amber-300 px-4 py-2 transition hover:bg-amber-400"
        to="/addNotizen"
      >
        + Notiz hinzufügen
      </router-link>

      <!-- Notizen Liste -->
      <div class="flex-1 overflow-y-auto pr-2">
        <div class="grid grid-cols-2 gap-5">
          <div
            v-for="note in notes"
            :key="note.id"
            class="flex h-64 flex-col rounded-xl border border-gray-300 bg-white p-4 shadow hover:bg-[#f7f5f3]"
          >
            <!-- Titel -->
            <h2 class="mb-3 truncate text-xl font-bold">
              {{ note.title }}
            </h2>

            <!-- Inhalt -->
            <div
              class="mb-3 flex-1 overflow-y-auto wrap-break-word text-sm leading-6 text-gray-700"
            >
              {{ note.content }}
            </div>

            <!-- Datum -->
            <p class="mb-4 text-xs text-gray-500">
              {{ formatDate(note.createdAt) }}
            </p>

            <div class="mt-auto flex justify-between gap-2">
              <button class="btn">Bearbeiten</button>

              <button class="btn" @click="deleteNote(note.id)">Löschen</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import api from '@/services/api'

const notes = ref([])
const noteToDelete = ref(null)

const getNotes = async () => {
  try {
    const response = await api.get('/notes')
    notes.value = response.data
  } catch (error) {
    console.log(error)
  }
}

const formatDate = (date) => {
  if (!date) return ''

  return new Date(date).toLocaleDateString('de-DE')
}


const deleteNote = async (id) => {
  try {
    await api.delete(`/notes/${id}`)

    notes.value = notes.value.filter(note => note.id !== id)

  } catch (error) {
    console.error(error)
  }
}

onMounted(() => {
  getNotes()
})
</script>
