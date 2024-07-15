<script setup>
import DatePicker from "primevue/datepicker";
import Dialog from "primevue/dialog";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import PlusButton from "@/Components/PlusButton.vue";
import { ref, watch } from "vue";

defineProps(['show'])
const show = defineModel('show')
const selectedPlan = ref(null);
const timePlan = ref('')
watch(show, s => {
  selectedPlan.value = null
})
watch(selectedPlan, plan => {
  timePlan.value = ''
})
</script>
<template>
  <Dialog v-model:visible="show" modal header="Select Existing Plan" :style="{ width: '32rem' }">
    <div class="px-5 py-4 rounded-lg border flex justify-between items-center gap-3 mt-3 first:mt-0" v-for="i in 3">
      <div>
        <h3 class="text-xl font-medium">Trip to Bali</h3>
        <div class="flex gap-3 mt-3 items-center">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
          </svg>
          <span>Nov 12, 2024 - Nov 16, 2024</span>
        </div>
        <div class="flex gap-4 items-center mt-3" v-if="selectedPlan == i">
          <div class="flex gap-2.5 items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <DatePicker v-model="timePlan" showTime hourFormat="24" :min-date="(new Date())"
              placeholder="mm/dd/yyyy --:--"></DatePicker>
          </div>
          <PrimaryButton class="px-3 py-1">Add</PrimaryButton>
        </div>
      </div>
      <PrimaryButton v-if="selectedPlan != i" @click="selectedPlan = i">Select</PrimaryButton>
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