<template>
  <div class="flex min-h-screen items-center justify-center">
    <div class="w-100 h-93 rounded-xl bg-[#FAEBD7] p-8 flex flex-col overflow-hidden">

      <div class="flex justify-between">
        <h1>Notizen Hinzufügen</h1>
        <p>Papierkorb</p>
      </div>

      <div class="flex flex-col flex-1 gap-2 mt-4">
        <input 
          type="text" 
          placeholder="Title" 
          class="border-2 border-solid p-2"
        >

        <textarea 
          placeholder="Notizen"
          class="border-2 border-solid p-2 flex-1 resize-none overflow-y-auto"
        ></textarea>

        <button class="border p-2">
          Add
        </button>
      </div>

    </div>
  </div>
</template>

<script setup>
</script>


