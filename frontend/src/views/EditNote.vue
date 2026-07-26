<template>
  <div class="flex min-h-screen items-center justify-center">
    <div class="w-100 h-93 rounded-xl bg-[#FAEBD7] p-8 flex flex-col overflow-hidden">
      <h1 class="mb-6 text-2xl font-bold">Notiz bearbeiten</h1>

      <form class="flex flex-col gap-4" @submit.prevent="saveNote">
        <div>
          <label class="block mb-2 font-semibold" for="title">Titel</label>
          <input
            id="title"
            v-model="title"
            class="w-full rounded border border-gray-300 bg-white px-3 py-2"
            type="text"
            placeholder="Titel eingeben"
          />
        </div>

        <div>
          <label class="block mb-2 font-semibold" for="content">Inhalt</label>
          <textarea
            id="content"
            v-model="content"
            class="w-full min-h-40` rounded border border-gray-300 bg-white px-3 py-2"
            placeholder="Notizinhalt eingeben"
          ></textarea>
        </div>

        <div class="flex items-center justify-between gap-3">
          <button
            type="submit"
            class="btn rounded bg-amber-300 px-4 py-2 font-semibold hover:bg-amber-400"
            @click="saveNote"
          >
            Speichern
          </button>
          <button
            type="button"
            class="btn rounded bg-gray-300 px-4 py-2 font-semibold hover:bg-gray-400"
            @click="cancel"
          >
            Abbrechen
          </button>
        </div>

        <p v-if="error" class="text-sm text-red-600">{{ error }}</p>
      </form>

      
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { fetchNote, updateNote } from '@/services/notes'

const route = useRoute()
const router = useRouter()
const noteId = route.params.id

const title = ref('')
const content = ref('')
const error = ref('')
const loading = ref(false)

const loadNote = async () => {
  if (!noteId) {
    error.value = 'Keine Notiz ausgewählt.'
    return
  }

  loading.value = true
  error.value = ''

  try {
    const data = await fetchNote(noteId)
    title.value = data.title
    content.value = data.content
  } catch (err) {
    error.value = 'Notiz konnte nicht geladen werden.'
    console.error(err)
  } finally {
    loading.value = false
  }
}

const saveNote = async () => {
  if (!title.value.trim() || !content.value.trim()) {
    error.value = 'Titel und Inhalt dürfen nicht leer sein.'
    return
  }

  try {
    await updateNote(noteId, {
      title: title.value,
      content: content.value,
    })
    router.push({ name: 'notizen' })
  } catch (err) {
    error.value = 'Beim Speichern ist ein Fehler aufgetreten.'
    console.error(err)
  }
}

const cancel = () => {
  router.push({ name: 'notizen' })
}

onMounted(loadNote)
</script>
