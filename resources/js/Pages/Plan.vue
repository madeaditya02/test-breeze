<script setup>
import ActivityCard from '@/Components/ActivityCard.vue';
import DeletePlanButton from '@/Components/DeletePlanButton.vue';
import FavoriteButton from '@/Components/FavoriteButton.vue';
import MapComponent from '@/Components/MapComponent.vue';
import PencilSquareIconButton from '@/Components/PencilSquareIconButton.vue';
import PlusButton from '@/Components/PlusButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ShareDialog from '@/Components/ShareDialog.vue';
import ShareIconButton from '@/Components/ShareIconButton.vue';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import DatePicker from 'primevue/datepicker';
import Popover from 'primevue/popover';
import Rating from 'primevue/rating';
import { ref, watch } from 'vue';

defineOptions({ layout: DashboardLayout });

const showAddPlan = ref(false);
const rating = ref(null);
const showShare = ref(false);
const timePlan = ref();
const showMap = ref(true);
watch(showAddPlan, () => {
  timePlan.value = null
})

const planAction = ref()
function showPlanAction(event) {
  planAction.value.toggle(event)
}

</script>
<template>
  <div class="flex justify-between">
    <div>
      <h1 class="text-3xl font-semibold">Trip to Bali</h1>
      <div class="flex gap-3 items-center my-5">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
          class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
        </svg>
        <span>Nov 12, 2024 - Nov 16, 2024</span>
      </div>
      <div class="flex gap-3 items-center">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
          class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
        </svg>
        <span>5 Activities, 3 Remains</span>
      </div>
    </div>
    <div class="flex items-end flex-col gap-4">
      <button @click="showPlanAction" class="lg:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
          class="size-7">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
        </svg>
      </button>
      <Popover ref="planAction">
        <div class="flex">
          <share-icon-button @share="showShare = true" />
          <FavoriteButton />
          <DeletePlanButton />
        </div>
      </Popover>
      <div class="hidden lg:flex gap-3">
        <share-icon-button @share="showShare = true" />
        <FavoriteButton />
        <DeletePlanButton />
      </div>
      <div class="hidden md:flex">
        <div class="w-[48px] h-[48px] rounded-full flex justify-center items-center text-white bg-blue-500 z-[2]">MA
        </div>
        <div
          class="w-[48px] h-[48px] rounded-full flex justify-center items-center text-white bg-green-500 relative -left-2">
          WP</div>
      </div>
    </div>
  </div>
  <div class="mt-8 flex gap-8 flex-col md:flex-row">
    <div class="md:w-[60%]">
      <h2 class="text-2xl font-semibold mb-4">Activities</h2>
      <div class="flex gap-4">
        <PlusButton v-if="!showAddPlan" @click="showAddPlan = true">Add Activity</PlusButton>
        <!-- <button class="inline-flex gap-2 px-3 py-2 rounded-lg border border-blue-primary text-blue-primary"
          @click="showMap = !showMap">
          <svg v-if="showMap" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
          </svg>
          <svg v-if="!showMap" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
          </svg>
          {{ showMap ? 'Hide' : 'Show' }} Map
        </button> -->
      </div>
      <div class="px-6 py-5 border rounded-xl mt-4" v-if="showAddPlan">
        <div class="flex gap-5 items-center">
          <div class="flex gap-2.5 items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <DatePicker v-model="timePlan" showTime hourFormat="24" :min-date="(new Date())"
              placeholder="mm/dd/yyyy --:--"></DatePicker>
          </div>
          <div class="flex gap-2.5 items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
            </svg>
            <button class="px-3 py-1 rounded-md border border-[#cbd5e1] hover:border-[#94a3b8]">Select Location</button>
          </div>
        </div>
        <div class="flex gap-2.5 mt-3 items-center">
          <PrimaryButton class="!py-1 text-sm !rounded-md">Add Activity</PrimaryButton>
          <button class="px-3 py-1 rounded-md border border-red-600 text-red-600 text-sm"
            @click="showAddPlan = false">Cancel</button>
        </div>
      </div>
      <MapComponent class="my-4" v-if="showMap" />
      <ActivityCard v-for="i in 2" />
      <hr class="mt-4">
      <div class="px-6 py-5 border rounded-xl flex justify-between items-center mt-4" v-for="i in 2">
        <div>
          <h3 class="text-xl font-semibold mb-2">Pantai Mertasari</h3>
          <div class="flex gap-2.5 items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <span>Yesterday, 19:00</span>
          </div>
        </div>
        <Rating v-model="rating" />
      </div>

    </div>
    <div class="md:w-[40%]">
      <div class="w-full bg-[#F2F2F2] rounded-xl px-4 py-2.5 h-fit max-h-full">
        <h2 class="text-2xl font-semibold mb-4">Trivia</h2>
        <!-- <div class="h-[150px] flex justify-center items-center text-gray-400 flex-col gap-4">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-10">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M15.042 21.672 13.684 16.6m0 0-2.51 2.225.569-9.47 5.227 7.917-3.286-.672ZM12 2.25V4.5m5.834.166-1.591 1.591M20.25 10.5H18M7.757 14.743l-1.59 1.59M6 10.5H3.75m4.007-4.243-1.59-1.59" />
          </svg>
          Select one place to view trivia
        </div> -->
        <img src="/img/beach.jpg" alt="" class="mt-4 w-[280px] max-w-full h-[160px] rounded-xl object-cover">
        <h3 class="text-xl font-semibold mt-4">Pantai Mertasari</h3>
        <p class="mt-4">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Excepturi architecto eligendi
          dignissimos itaque doloribus fugiat magni minus atque, delectus necessitatibus quod sunt ut eius dolore quae
          esse sint provident! Sed?</p>
        <h3 class="text-lg font-medium mt-4">Sejarah</h3>
        <p class="mt-4">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Excepturi architecto eligendi
          dignissimos itaque doloribus fugiat magni minus atque, delectus necessitatibus quod sunt ut eius dolore quae
          esse sint provident! Sed?</p>
      </div>
    </div>
  </div>

  <ShareDialog v-model:visible="showShare" />
</template>
<style>
.p-datepicker-input {
  padding: 4px 12px !important;
}
</style>