<script setup>
import CurrentPlans from '@/Components/CurrentPlans.vue';
import NewPlanModal from '@/Components/NewPlanModal.vue';
import PlanCard from '@/Components/PlanCard.vue';
import PlusButton from '@/Components/PlusButton.vue';
import ShareDialog from '@/Components/ShareDialog.vue';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { planStatus } from '@/util';
import ConfirmDialog from 'primevue/confirmdialog';
import { useConfirm } from 'primevue/useconfirm';
import { computed, ref, watch } from 'vue';
import { router } from "@inertiajs/vue3";

defineOptions({ layout: DashboardLayout });
const props = defineProps(['plans'])

const showNewPlanModal = ref(false)
const currentPlans = computed(() => props.plans.filter(plan => planStatus(plan) != 'Completed').slice(0, 5).sort((a, b) => new Date(a.start_date) - new Date(b.start_date)))

const confirm = useConfirm()
const deletedPlan = ref()
function confirmDelete(plan) {
  deletedPlan.value = plan
  confirm.require({
    message: 'Do you want to delete this plan?',
    header: 'Delete Plan',
    rejectLabel: 'Cancel',
    rejectProps: {
      label: 'Cancel',
      severity: 'secondary',
      outlined: true
    },
    acceptProps: {
      label: 'Delete',
      severity: 'danger'
    },
    accept: () => {
      router.delete(`/dashboard/plan/${plan.id}`)
      confirm.close()
    },
    reject: () => {
      deletedPlan.value = null
    }
  });
}

const showShare = ref(false)
const sharedPlan = ref()
function share(plan) {
  showShare.value = true
  sharedPlan.value = plan
}
watch(showShare, val => !val ? sharedPlan.value = null : null)
</script>
<template>
  <h1 class="text-3xl font-semibold mb-5">My Plans</h1>
  <CurrentPlans @share-plan="plan => share(plan)" :current-plans="currentPlans" />

  <h1 class="text-3xl font-semibold mt-12 mb-5">All Plans</h1>
  <PlusButton class="mb-5" @click="showNewPlanModal = true">
    Add New Plan
  </PlusButton>
  <div class="flex flex-col gap-5">
    <PlanCard v-for="plan in plans" @share-plan="share(plan)" :plan="plan" @delete="confirmDelete(plan)" />
  </div>

  <ShareDialog v-model:visible="showShare" :plan="sharedPlan" />
  <!-- <div v-if="plans.length > 0" v-for="plan in plans">
    <ShareDialog v-model:visible="showShare" :plan="plan" />
  </div> -->
  <NewPlanModal v-model:show="showNewPlanModal" :user="$page.props.auth.user" />

  <!-- <ConfirmDialog>
    <template #icon>
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
      class="size-12 text-red-600">
      <path stroke-linecap="round" stroke-linejoin="round"
      d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
    </svg>
  </template>
</ConfirmDialog> -->
</template>