<script setup>
import DeletePlanButton from '@/Components/DeletePlanButton.vue';
import FavoriteButton from '@/Components/FavoriteButton.vue';
import PencilSquareIconButton from '@/Components/PencilSquareIconButton.vue';
import PlusButton from '@/Components/PlusButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ShareDialog from '@/Components/ShareDialog.vue';
import ShareIconButton from '@/Components/ShareIconButton.vue';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import DatePicker from 'primevue/datepicker';
import Rating from 'primevue/rating';
import { ref } from 'vue';

defineOptions({ layout: DashboardLayout });

const showAddPlan = ref(false);
const rating = ref(null);
const showShare = ref(false);
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
      <div class="flex gap-3">
        <share-icon-button @share="showShare = true" />
        <FavoriteButton />
        <DeletePlanButton />
      </div>
      <div class="flex">
        <div class="w-[48px] h-[48px] rounded-full flex justify-center items-center text-white bg-blue-500 z-[2]">MA
        </div>
        <div
          class="w-[48px] h-[48px] rounded-full flex justify-center items-center text-white bg-green-500 relative -left-2">
          WP</div>
      </div>
    </div>
  </div>
  <div class="mt-8 flex gap-8">
    <div class="w-[60%]">
      <h2 class="text-2xl font-semibold mb-4">Activities</h2>
      <PlusButton v-if="!showAddPlan" @click="showAddPlan = true">Add Activity</PlusButton>
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
      <div class="px-6 py-5 border rounded-xl flex items-center gap-7 mt-4" v-for="i in 1">
        <img src="/img/beach.jpg" alt="" class="w-[160px] h-[120px] object-cover rounded-xl">
        <div class="flex-grow">
          <div class="flex justify-between">
            <h3 class="text-xl font-semibold">Pantai Mertasari</h3>
            <div class="flex gap-3">
              <PencilSquareIconButton />
              <DeletePlanButton />
            </div>
          </div>
          <div class="flex gap-2.5 items-center mt-2 mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <span>Today, 16:00</span>
          </div>
          <PrimaryButton size="sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
            </svg>
            <span>View Location</span>
          </PrimaryButton>
        </div>
      </div>
    </div>
    <div class="w-[40%] bg-[#F2F2F2] rounded-xl px-4 py-2.5 h-fit max-h-full">
      <h2 class="text-2xl font-semibold mb-4">Trivia</h2>
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

  <ShareDialog v-model:visible="showShare" />
</template>
<style>
.p-datepicker-input {
  padding: 4px 12px !important;
}
</style>