<script setup>
defineProps(['status'])
const statusColors = {
  'Upcoming': 'bg-yellow-100 text-yellow-800',
  'On Going': 'bg-green-100 text-green-800',
  'Completed': 'bg-blue-100 text-blue-800',
}
</script>
<template>
  <span :class="`px-2 py-1 rounded-lg font-semibold text-xs ${statusColors[status]}`">
    {{ status }}
  </span>
</template>