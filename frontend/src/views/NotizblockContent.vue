<template>
  <div class="flex min-h-screen items-center justify-center">
    <div class="w-100 h-93 rounded-xl bg-[#FAEBD7] p-8 flex flex-col overflow-hidden">
      <div class="flex justify-between">
        <h1 class="btn">Notizen Hinzufügen</h1>
        <p class="btn">Papierkorb</p>
      </div>

      <form class="flex flex-col flex-1 gap-2 mt-4" @submit.prevent="submitNote">
        <input
          v-model="form.title"
          type="text"
          placeholder="Title"
          class="border-2 border-solid p-2"
        >

        <textarea
          v-model="form.content"
          placeholder="Notizen"
          class="border-2 border-solid p-2 flex-1 resize-none overflow-y-auto"
        ></textarea>

        <p v-if="message" class="text-sm" :class="messageType === 'error' ? 'text-red-600' : 'text-green-600'">
          {{ message }}
        </p>

        <button class="btn" :disabled="isSubmitting" type="submit">
          {{ isSubmitting ? 'Wird gespeichert...' : 'Add' }}
        </button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { createNote } from '@/services/notes';

const router = useRouter();
const form = ref({ title: '', content: '' });
const message = ref('');
const messageType = ref('success');
const isSubmitting = ref(false);

const submitNote = async () => {
  if (!form.value.title.trim() || !form.value.content.trim()) {
    message.value = 'Bitte Titel und Inhalt ausfüllen.';
    messageType.value = 'error';
    return;
  }

  isSubmitting.value = true;
  message.value = '';

  try {
    await createNote({
      title: form.value.title.trim(),
      content: form.value.content.trim(),
    });

    form.value.title = '';
    form.value.content = '';
    message.value = 'Notiz wurde gespeichert.';
    messageType.value = 'success';

    setTimeout(() => {
      router.push('/');
    }, 600);
  } catch (error) {
    console.error(error);
    message.value = 'Fehler beim Speichern der Notiz.';
    messageType.value = 'error';
  } finally {
    isSubmitting.value = false;
  }
};
</script>


