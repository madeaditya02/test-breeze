<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps(['class', 'size', 'asLink', 'external'])
const customClass = `btn-${props.size ?? 'base'} ${props.class ?? ''}`;
defineEmits(['click'])

</script>
<template>
  <Link v-if="asLink && external == undefined" :href="asLink"
    class="inline-flex px-3 py-2 rounded-lg gap-2.5 items-center bg-blue-primary border border-blue-primary text-white hover:bg-sky-600 active:bg-blue-700"
    :class="customClass" @click="event => $emit('click', event)">
  <slot />
  </Link>
  <a v-if="asLink && external != undefined" :href="asLink" target="_blank"
    class="inline-flex px-3 py-2 rounded-lg gap-2.5 items-center bg-blue-primary border border-blue-primary text-white hover:bg-sky-600 active:bg-blue-700"
    :class="customClass" @click="event => $emit('click', event)">
    <slot />
  </a>
  <button v-if="!asLink"
    class="inline-flex px-3 py-2 rounded-lg gap-2.5 items-center bg-blue-primary border border-blue-primary text-white hover:bg-sky-600 active:bg-blue-700"
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