<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps(['class', 'size', 'asLink'])
const customClass = `btn-${props.size ?? 'base'} ${props.class ?? ''}`;
defineEmits(['click'])
</script>
<template>
  <Link v-if="asLink" :href="asLink"
    class="inline-flex w-fit px-3 py-2 rounded-lg gap-2.5 items-center bg-white border border-blue-primary text-blue-primary hover:bg-blue-primary hover:text-white transition duration-150"
    :class="customClass" @click="event => $emit('click', event)">
  <slot />
  </Link>
  <button v-if="!asLink"
    class="inline-flex w-fit px-3 py-2 rounded-lg gap-2.5 items-center bg-white border border-blue-primary text-blue-primary hover:bg-blue-primary hover:text-white transition duration-150"
    :class="customClass" @click="event => $emit('click', event)">
    <slot />
  </button>
</template>
<style>
.btn-sm {
  padding: 5px 8px !important;
  font-size: 12px;
  gap: 4px;
}

.btn-sm svg {
  width: 16px;
  height: 16px;
}
</style>