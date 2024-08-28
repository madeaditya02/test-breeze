<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps(['class', 'size', 'asLink', 'external'])
const customClass = `btn-${props.size ?? 'base'} ${props.class ?? ''}`;
defineEmits(['click'])
console.log(props.external);

</script>
<template>
  <Link v-if="asLink && external == undefined" :href="asLink"
    class="size-8 flex justify-center items-center rounded-lg hover:bg-gray-100" :class="customClass"
    @click="event => $emit('click', event)">
  <slot />
  </Link>
  <a v-if="asLink && external != undefined" :href="asLink" target="_blank"
    class="size-8 flex justify-center items-center rounded-lg hover:bg-gray-50 active:bg-gray-100" :class="customClass"
    @click="event => $emit('click', event)">
    <slot />
  </a>
  <button v-if="!asLink" class="size-8 flex justify-center items-center rounded-lg hover:bg-gray-100"
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