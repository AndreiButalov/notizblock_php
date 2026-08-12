<template>
  <div class="flex min-h-screen items-center justify-center px-4 py-6">
    <div
      class="add-note-shell flex h-auto max-h-[90vh] w-full max-w-2xl flex-col overflow-hidden rounded-xl bg-[#FAEBD7] p-3 sm:p-4 md:p-8"
    >
      <div
        class="add-note-header flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between"
      >
        <h1 class="text-xl font-bold sm:text-2xl">
          Notizen Hinzufügen
        </h1>
                
      </div>

      <form
        class="add-note-form mt-4 flex flex-1 flex-col gap-3"
        @submit.prevent="submitNote"
      >
        <input
          v-model="form.title"
          type="text"
          placeholder="Title"
          class="rounded border-2 border-solid border-gray-300 bg-white p-2"
        />

        <textarea
          v-model="form.content"
          placeholder="Notizen"
          class="min-h-40 flex-1 resize-none overflow-y-auto rounded border-2 border-solid border-gray-300 bg-white p-2"
        ></textarea>

        <p
          v-if="message"
          class="text-sm"
          :class="
            messageType === 'error'
              ? 'text-red-600'
              : 'text-green-600'
          "
        >
          {{ message }}
        </p>

        <button
          class="w-full rounded bg-amber-300 px-4 py-2 font-semibold hover:bg-amber-400 disabled:cursor-not-allowed disabled:opacity-50"
          :disabled="isSubmitting"
          type="submit"
        >
          {{ isSubmitting ? 'Wird gespeichert...' : 'Add' }}
        </button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { createNote } from '@/services/notes'

const router = useRouter()

const form = ref({
  title: '',
  content: '',
})

const message = ref('')
const messageType = ref('success')
const isSubmitting = ref(false)

const submitNote = async () => {
  if (!form.value.title.trim() || !form.value.content.trim()) {
    message.value = 'Bitte Titel und Inhalt ausfüllen.'
    messageType.value = 'error'
    return
  }

  isSubmitting.value = true
  message.value = ''

  try {
    await createNote({
      title: form.value.title.trim(),
      content: form.value.content.trim(),
    })

    form.value.title = ''
    form.value.content = ''
    message.value = 'Notiz wurde gespeichert.'
    messageType.value = 'success'

    setTimeout(() => {
      router.push('/')
    }, 600)
  } catch (error) {
    console.error(error)
    message.value = 'Fehler beim Speichern der Notiz.'
    messageType.value = 'error'
  } finally {
    isSubmitting.value = false
  }
}
</script>