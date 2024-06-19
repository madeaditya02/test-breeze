<script setup>
import { ref, onMounted, defineProps } from "vue";
const { plans } = defineProps(['plans'])
</script>
<template>
  <div>Plans :</div>
  <ul>
    <li v-for="(plan, i) in plans"><a :href="`/plans/${plan.id}`">Plan {{ i + 1 }} : {{ plan.id }}</a></li>
  </ul>
</template>