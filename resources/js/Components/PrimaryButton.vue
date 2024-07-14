<script setup>
const props = defineProps(['class', 'size'])
const customClass = `btn-${props.size ?? 'base'} ${props.class ?? ''}`;
defineEmits(['click'])
</script>
<template>
    <button
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