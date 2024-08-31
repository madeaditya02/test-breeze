<script setup>
import CurrentPlans from '@/Components/CurrentPlans.vue';
import NewPlanModal from '@/Components/NewPlanModal.vue';
import PlanCard from '@/Components/PlanCard.vue';
import PlusButton from '@/Components/PlusButton.vue';
import ShareDialog from '@/Components/ShareDialog.vue';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { planStatus } from '@/util';
import { computed, ref } from 'vue';

defineOptions({ layout: DashboardLayout });
const props = defineProps(['plans'])

const showNewPlanModal = ref(false)
const showShare = ref(false)
const currentPlans = computed(() => props.plans.filter(plan => planStatus(plan.activities) != 'Completed').slice(0, 5))
</script>
<template>
  <h1 class="text-3xl font-semibold mb-5">My Plans</h1>
  <CurrentPlans @share-plan="showShare = true" :current-plans="currentPlans" />

  <h1 class="text-3xl font-semibold mt-12 mb-5">All Plans</h1>
  <PlusButton class="mb-5" @click="showNewPlanModal = true">
    Add New Plan
  </PlusButton>
  <div class="flex flex-col gap-5">
    <PlanCard v-for="plan in plans" @share-plan="showShare = true" :plan="plan" />
  </div>


  <div v-if="plans.length > 0" v-for="plan in plans">
    <ShareDialog v-model:visible="showShare" :plan="plan" />
  </div>
  <NewPlanModal v-model:show="showNewPlanModal" :user="$page.props.auth.user" />
</template>