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
import NewPlanModal from "@/Components/NewPlanModal.vue";
import ExistingPlanModal from "@/Components/ExistingPlanModal.vue";

defineOptions({ layout: DashboardLayout });
const props = defineProps(['plans'])

const showModal = ref(false);
const showNewPlanModal = ref(false);

const showShare = ref(false)
console.log(props.plans);

</script>
<template>
  <h1 class="text-3xl font-semibold mb-5">My Plans</h1>
  <PlusButton class="mb-5" @click="showNewPlanModal = true">
    Add New Plan
  </PlusButton>

  <CurrentPlans :current-plans="plans" @share-plan="showShare = true" />

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
    <swiper :slidesPerView="'auto'" :spaceBetween="10" :pagination="{
    clickable: true,
  }">
      <swiper-slide v-for="i in 7">
        <destination-card @show-modal="showModal = true" @show-new-plan-modal="showNewPlanModal = true" />
      </swiper-slide>
    </swiper>
  </div>

  <ExistingPlanModal v-model:show="showModal" />
  <NewPlanModal v-model:show="showNewPlanModal" />

  <ShareDialog v-if="plans.length > 0" v-model:visible="showShare" :plan="plans[0]" />
</template>
<style>
.recommendations .swiper-slide {
  width: 35%;
}

@media (max-width: 640px) {
  .recommendations .swiper-slide {
    width: 85%;
  }
}


.p-datepicker-input {
  padding: 4px 12px !important;
}

.new-plan-dialog .p-datepicker-input {
  width: 8rem;
}

/* .swiper-slide:nth-child(2n) {
  width: 60%;
}

.swiper-slide:nth-child(3n) {
  width: 40%;
} */
</style>
