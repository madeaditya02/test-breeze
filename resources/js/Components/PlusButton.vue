<script setup>
import { Link } from '@inertiajs/vue3';

defineProps(['class', 'asLink'])
defineEmits(['click'])
</script>
<template>
  <Link v-if="asLink" :href="asLink"
    class="inline-flex px-3 py-2 rounded-lg gap-2.5 items-center bg-blue-primary text-white hover:bg-sky-600 active:bg-blue-700"
    :class="class" @click="event => $emit('click', event)">
  <svg xmlns="http://www.w3.org/2000/svg" fill="#fff" viewBox="0 0 24 24" stroke-width="1.5" stroke="#fff"
    class="size-5">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
  </svg>
  <slot />
  </Link>
  <button v-if="!asLink"
    class="inline-flex px-3 py-2 rounded-lg gap-2.5 items-center bg-blue-primary text-white hover:bg-sky-600 active:bg-blue-700"
    :class="class" @click="event => $emit('click', event)">
    <svg xmlns="http://www.w3.org/2000/svg" fill="#fff" viewBox="0 0 24 24" stroke-width="1.5" stroke="#fff"
      class="size-5">
      <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
    </svg>
    <slot />
  </button>
</template>
