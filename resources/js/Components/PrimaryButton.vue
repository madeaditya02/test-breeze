<script setup>
defineProps(['class'])
defineEmits(['click'])
</script>
<template>
    <button
        class="inline-flex px-3 py-2 rounded-lg gap-2.5 items-center bg-blue-primary text-white hover:bg-sky-600 active:bg-blue-700"
        :class="class" @click="event => $emit('click', event)">
        <slot />
    </button>
</template>
