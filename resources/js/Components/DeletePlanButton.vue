<script setup>
defineEmits(['favorite'])
</script>
<template>
  <button @click="$emit('favorite')"
    class="w-[36px] h-[36px] flex justify-center items-center p-1.5 hover:bg-gray-100 rounded-lg">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
      class="size-6">
      <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
    </svg>
  </button>
</template>