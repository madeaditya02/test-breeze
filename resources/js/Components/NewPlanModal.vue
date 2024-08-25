<script setup>
import DatePicker from "primevue/datepicker";
import Dialog from "primevue/dialog";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import PlusButton from "@/Components/PlusButton.vue";
import { ref, watch } from "vue";
import { router } from "@inertiajs/vue3";
import axios from "axios";

defineProps(['show'])
const show = defineModel('show')

const rangePlan = ref([new Date(), '']);
const formData = ref({
  name: '',
  startDate: new Date(),
  endDate: new Date(),
})
watch(show, s => {
  rangePlan.value = ['', '']
})

function createPlan(form) {
  axios;
}
</script>
<template>
  <Dialog v-model:visible="show" modal :style="{ width: '32rem' }">
    <template #container="{ closeCallback }">
      <div class="px-7 py-5 new-plan-dialog">
        <div class="flex justify-between gap-8">
          <input type="text" placeholder="Plan name"
            class="plain-input block w-full p-0 border-none text-2xl focus:outline-none focus:border-none active:border-none active:outline-none"
            v-model="formData.name">
          <button @click="closeCallback">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <div class="flex gap-2.5 items-center my-5">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
          </svg>
          <DatePicker v-model="formData.startDate" :min-date="(new Date())" :manual-input="false"
            placeholder="mm/dd/yyyy">
          </DatePicker>
          <span>-</span>
          <DatePicker v-model="formData.endDate" :min-date="formData.startDate" :manual-input="false"
            placeholder="mm/dd/yyyy">
          </DatePicker>
        </div>
        <PlusButton @click="createPlan(formData)">Add Plan</PlusButton>
      </div>
    </template>
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