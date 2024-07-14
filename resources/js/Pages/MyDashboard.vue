<script setup>
import { ref, watch } from "vue";
import DashboardLayout from '../Layouts/DashboardLayout.vue';
import CurrentPlans from "@/Components/CurrentPlans.vue";
import DestinationCard from "@/Components/DestinationCard.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Dialog from "primevue/dialog";
import DatePicker from "primevue/datepicker";
import ShareDialog from "@/Components/ShareDialog.vue";
import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/css';
import 'swiper/css/pagination';
import PlusButton from "@/Components/PlusButton.vue";

defineOptions({ layout: DashboardLayout });
const showModal = ref(false);
const selectedPlan = ref(null);
const timePlan = ref('')
watch(showModal, show => {
  selectedPlan.value = null
})
watch(selectedPlan, plan => {
  timePlan.value = ''
})
const showNewPlanModal = ref(false);
const rangePlan = ref(['', ''])
watch(showNewPlanModal, show => {
  rangePlan.value = ['', '']
})

const showShare = ref(false)
</script>
<template>
  <h1 class="text-3xl font-semibold mb-5">My Plans</h1>
  <PlusButton class="mb-5" @click="showNewPlanModal = true">
    Add New Plan
  </PlusButton>

  <CurrentPlans @share-plan="showShare = true" />

  <h1 class="text-3xl font-semibold mb-5 mt-12">Recommended for You</h1>
  <div class="inline-flex mb-3 gap-3 items-center px-3 py-2 rounded-lg border text-[rgba(0,0,0,0.5)] text-base">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="w-[20px] fill-[rgba(0,0,0,0.5)]">
      <path
        d="M346.3 271.8l-60.1-21.9L214 448H32c-17.7 0-32 14.3-32 32s14.3 32 32 32H544c17.7 0 32-14.3 32-32s-14.3-32-32-32H282.1l64.1-176.2zm121.1-.2l-3.3 9.1 67.7 24.6c18.1 6.6 38-4.2 39.6-23.4c6.5-78.5-23.9-155.5-80.8-208.5c2 8 3.2 16.3 3.4 24.8l.2 6c1.8 57-7.3 113.8-26.8 167.4zM462 99.1c-1.1-34.4-22.5-64.8-54.4-77.4c-.9-.4-1.9-.7-2.8-1.1c-33-11.7-69.8-2.4-93.1 23.8l-4 4.5C272.4 88.3 245 134.2 226.8 184l-3.3 9.1L434 269.7l3.3-9.1c18.1-49.8 26.6-102.5 24.9-155.5l-.2-6zM107.2 112.9c-11.1 15.7-2.8 36.8 15.3 43.4l71 25.8 3.3-9.1c19.5-53.6 49.1-103 87.1-145.5l4-4.5c6.2-6.9 13.1-13 20.5-18.2c-79.6 2.5-154.7 42.2-201.2 108z" />
    </svg>
    <span>Beach</span>
  </div>
  <div class="recommendations">
    <swiper :slidesPerView="'auto'" :spaceBetween="30" :pagination="{
      clickable: true,
    }">
      <swiper-slide v-for="i in 7">
        <destination-card @show-modal="showModal = true" @show-new-plan-modal="showNewPlanModal = true" />
      </swiper-slide>
    </swiper>
  </div>
  <div class="inline-flex mt-5 mb-3 gap-3 items-center px-3 py-2 rounded-lg border text-[rgba(0,0,0,0.5)] text-base">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-[20px] fill-[rgba(0,0,0,0.5)]">
      <path
        d="M240.1 4.2c9.8-5.6 21.9-5.6 31.8 0l171.8 98.1L448 104l0 .9 47.9 27.4c12.6 7.2 18.8 22 15.1 36s-16.4 23.8-30.9 23.8H32c-14.5 0-27.2-9.8-30.9-23.8s2.5-28.8 15.1-36L64 104.9V104l4.4-1.6L240.1 4.2zM64 224h64V416h40V224h64V416h48V224h64V416h40V224h64V420.3c.6 .3 1.2 .7 1.8 1.1l48 32c11.7 7.8 17 22.4 12.9 35.9S494.1 512 480 512H32c-14.1 0-26.5-9.2-30.6-22.7s1.1-28.1 12.9-35.9l48-32c.6-.4 1.2-.7 1.8-1.1V224z" />
    </svg>
    <span>Landmark</span>
  </div>
  <div class="recommendations">
    <swiper :slidesPerView="'auto'" :spaceBetween="30" :pagination="{
      clickable: true,
    }">
      <swiper-slide v-for="i in 7">
        <destination-card @show-modal="showModal = true" @show-new-plan-modal="showNewPlanModal = true" />
      </swiper-slide>
    </swiper>
  </div>

  <Dialog v-model:visible="showModal" modal header="Select Existing Plan" :style="{ width: '32rem' }">
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

  <Dialog v-model:visible="showNewPlanModal" modal :style="{ width: '32rem' }">
    <template #container="{ closeCallback }">
      <div class="px-7 py-5 new-plan-dialog">
        <div class="flex justify-between gap-8">
          <input type="text" placeholder="Plan name"
            class="plain-input block w-full p-0 border-none text-2xl focus:outline-none focus:border-none active:border-none active:outline-none">
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
          <DatePicker v-model="rangePlan[0]" :min-date="(new Date())" :manual-input="false" placeholder="mm/dd/yyyy">
          </DatePicker>
          <span>-</span>
          <DatePicker v-model="rangePlan[1]" :min-date="(new Date())" :manual-input="false" placeholder="mm/dd/yyyy">
          </DatePicker>
        </div>
        <PlusButton>Add Plan</PlusButton>
      </div>
    </template>
  </Dialog>

  <ShareDialog v-model:visible="showShare" />
</template>
<style>
.recommendations .swiper-slide {
  width: 35%;
}

.p-datepicker-input {
  padding: 4px 12px !important;
}

.new-plan-dialog .p-datepicker-input {
  width: 8rem;
}

.plain-input,
.plain-input:focus {
  outline: none !important;
  border: none !important;
  box-shadow: none !important;
  /* Pastikan box-shadow juga dihapus */
}

.plain-input:focus-visible {}

/* .swiper-slide:nth-child(2n) {
  width: 60%;
}

.swiper-slide:nth-child(3n) {
  width: 40%;
} */
</style>
