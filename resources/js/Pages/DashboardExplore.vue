<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import ExploreBody from '../Components/ExploreBody.vue';
defineProps(['plans'])
</script>
<template>
  <DashboardLayout>
    <ExploreBody :plans="plans" />
  </DashboardLayout>
</template>