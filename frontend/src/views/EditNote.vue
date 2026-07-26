<template>
  <div class="flex min-h-screen items-center justify-center">
    <div class="w-100 h-93 rounded-xl bg-[#FAEBD7] p-8 flex flex-col overflow-hidden">
        <h1>Edit</h1>
    </div>
  </div>
</template>

<script setup>
import { useRoute } from 'vue-router'

const route = useRoute()

const noteId = route.params.id


console.log(noteId)

</script>
