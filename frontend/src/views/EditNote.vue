<template>
  <div class="flex min-h-screen items-center justify-center p-4">
    <div
      class="edit-shell flex h-auto max-h-[90vh] w-full max-w-2xl flex-col overflow-hidden rounded-xl bg-[#FAEBD7] p-4 sm:p-6 md:p-8"
    >
      <h1 class="mb-6 text-xl font-bold sm:text-2xl">
        Notiz bearbeiten
      </h1>

      <form
        class="edit-form flex flex-col gap-4"
        @submit.prevent="saveNote"
      >
        <div>
          <label
            class="mb-2 block font-semibold"
            for="title"
          >
            Titel
          </label>

          <input
            id="title"
            v-model="title"
            class="w-full rounded border border-gray-300 bg-white px-3 py-2"
            type="text"
            placeholder="Titel eingeben"
          />
        </div>

        <div>
          <label
            class="mb-2 block font-semibold"
            for="content"
          >
            Inhalt
          </label>

          <textarea
            id="content"
            v-model="content"
            class="min-h-40 w-full resize-none rounded border border-gray-300 bg-white px-3 py-2"
            placeholder="Notizinhalt eingeben"
          ></textarea>
        </div>

        <div
          class="edit-actions flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between"
        >
          <button
            type="submit"
            class="w-full rounded bg-amber-300 px-4 py-2 font-semibold hover:bg-amber-400 sm:w-auto"
          >
            Speichern
          </button>

          <button
            type="button"
            class="w-full rounded bg-gray-300 px-4 py-2 font-semibold hover:bg-gray-400 sm:w-auto"
            @click="cancel"
          >
            Abbrechen
          </button>
        </div>

        <p
          v-if="error"
          class="text-sm text-red-600"
        >
          {{ error }}
        </p>
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