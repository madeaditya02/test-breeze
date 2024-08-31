<script setup>
import DatePicker from "primevue/datepicker";
import Dialog from "primevue/dialog";
import Button from "primevue/button";
import { ref, watch, defineEmits } from "vue";
import axios from "axios";
import { placePhoto } from "@/util";
import SelectLocation from "@/Components/SelectLocation.vue";

const props = defineProps(['show', 'activity', 'plan']);
const show = defineModel('show')
const emit = defineEmits(['submitted'])

const showSelectPlace = ref(false);
const place = ref(null);

const formData = ref({
  time: props.activity.time,
  place: null
});

watch(show, s => {
  place.value = null;
})

function editActivity(form) {
  axios.put(`/dashboard/plans/${props.activity.plan_id}/activities/${props.activity.id}`, form)
    .then(() => {
      show.value = false;
      emit('submitted');
    }).catch((err) => {
      console.log(err);
    });
}

function handleSelectedLocation(place) {
  console.log(place);
  formData.value.place = place;
}
</script>
<template>
  <Dialog v-model:visible="show" modal :style="{ width: '32rem' }">
    <template #container="{ closeCallback }">
      <div class="px-7 py-5 new-plan-dialog">
        <div class="flex justify-between gap-8">
          <h2 class="font-bold text-xl">Edit Activity</h2>
          <button @click="closeCallback">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <div>
          <h3 class="text-lg">Current Location:</h3>
          <div
            class="px-6 py-5 border rounded-xl flex md:items-center gap-3 sm:gap-4 lg:gap-7 mt-4 flex-col md:flex-row">
            <img :src="place == null ? placePhoto(activity.photo) : placePhoto(place.photo)" alt=""
              class="md:w-[160px] w-full h-[120px] object-cover rounded-xl">
            <div class="flex-grow">
              <div class="flex justify-between">
                <h3 class="text-xl font-semibold">{{ place == null ? activity.name : place.name }}</h3>
              </div>
            </div>
          </div>
          <Button label="Change location" class="mt-2" @click="showSelectPlace = true" />
        </div>
        <div class="flex gap-2.5 items-center my-5">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
          </svg>
          <DatePicker v-model="formData.time" :min-date="(new Date())" :manual-input="false" showTime hourFormat="24"
            placeholder="mm/dd/yyyy --:--">
          </DatePicker>
        </div>
        <Button @click="editActivity(formData)">Update</Button>
      </div>
    </template>
  </Dialog>
  <SelectLocation v-model="showSelectPlace" @selected="handleSelectedLocation" />
</template>
<style>
.plain-input,
.plain-input:focus {
  outline: none !important;
  border: none !important;
  box-shadow: none !important;
}
</style>