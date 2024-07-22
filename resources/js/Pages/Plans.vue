<script setup>
import CurrentPlans from '@/Components/CurrentPlans.vue';
import NewPlanModal from '@/Components/NewPlanModal.vue';
import PlanCard from '@/Components/PlanCard.vue';
import PlusButton from '@/Components/PlusButton.vue';
import ShareDialog from '@/Components/ShareDialog.vue';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { ref } from 'vue';

defineOptions({ layout: DashboardLayout });
const showNewPlanModal = ref(false)
const showShare = ref(false)
</script>
<template>
  <h1 class="text-3xl font-semibold mb-5">My Plans</h1>
  <CurrentPlans @share-plan="showShare = true" />

  <h1 class="text-3xl font-semibold mt-12 mb-5">All Plans</h1>
  <PlusButton class="mb-5" @click="showNewPlanModal = true">
    Add New Plan
  </PlusButton>
  <div class="flex flex-col gap-5">
    <PlanCard v-for="i in 3" @share-plan="showShare = true" />
  </div>

  <ShareDialog v-model:visible="showShare" />
  <NewPlanModal v-model:show="showNewPlanModal" />
</template>