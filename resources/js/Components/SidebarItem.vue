<script setup>
import { Link, router, usePage } from '@inertiajs/vue3';
import { defineProps } from 'vue';


defineProps(['to', 'text', 'isActive']);
</script>

<template>
  <Link :href="to" class="flex gap-4 px-2.5 py-2 items-center w-full rounded-lg"
    :class="isActive ? 'bg-blue-light text-blue-dark' : 'hover:bg-blue-light'">
  <slot name="icon"></slot>
  <span>{{ text }}</span>
  </Link>
</template>