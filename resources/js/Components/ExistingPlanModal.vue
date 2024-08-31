<script setup>
import DatePicker from "primevue/datepicker";
import Dialog from "primevue/dialog";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import PlusButton from "@/Components/PlusButton.vue";
import { ref, watch } from "vue";
import { rangePlan } from "@/util";
import { router } from "@inertiajs/vue3";
import Button from "primevue/button";

const props = defineProps(['show', 'plans', 'selectedPlace'])
const show = defineModel('show')
const selectedPlan = ref(null);
const timePlan = ref('')
watch(show, s => {
  selectedPlan.value = null
})
watch(selectedPlan, plan => {
  timePlan.value = ''
})

const loading = ref(false)
async function submitPlan() {
  loading.value = true
  const res = await axios.post(`/dashboard/plans/${selectedPlan.value.id}/activities`, {
    data: { time: timePlan.value, place: props.selectedPlace },
  })
  router.visit(`/dashboard/plans/${selectedPlan.value.public_id}`)
}
</script>
<template>
  <Dialog v-model:visible="show" modal header="Select Existing Plan" :style="{ width: '32rem' }">
    <div class="px-5 py-4 rounded-lg border flex justify-between items-center gap-3 mt-3 first:mt-0"
      v-for="plan in plans">
      <div>
        <h3 class="text-xl font-medium">{{ plan.name }}</h3>
        <div class="flex gap-3 mt-3 items-center">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
          </svg>
          <span>{{ rangePlan(plan) }}</span>
        </div>
        <form class="flex gap-4 items-center mt-3" v-if="selectedPlan == plan" @submit.prevent="submitPlan">
          <div class="flex gap-2.5 items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <DatePicker v-model="timePlan" showTime hourFormat="24" :min-date="new Date(plan.start_date)"
              :max-date="new Date(plan.end_date)" placeholder="mm/dd/yyyy --:--"></DatePicker>
          </div>
          <Button type="submit" class="px-3 py-1" :disabled="loading || !selectedPlace || timePlan == ''">
            <svg v-if="loading" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="size-6 animate-spin inline">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
            </svg>
            Add
          </Button>
        </form>
      </div>
      <PrimaryButton v-if="selectedPlan != plan" @click="selectedPlan = plan">Select</PrimaryButton>
    </div>
  </Dialog>
</template>
<style>
.plain-input,
.plain-input:focus {
  outline: none !important;
  border: none !important;
  box-shadow: none !important;
  /* Pastikan box-shadow juga dihapus */
}
</style>