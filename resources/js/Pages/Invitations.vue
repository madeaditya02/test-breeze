<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import PlusButton from '@/Components/PlusButton.vue';
import moment from 'moment';
import { rangePlan } from '@/util';

defineOptions({ layout: DashboardLayout });
const props = defineProps(['notifications'])
</script>
<template>
  <h1 class="text-3xl font-semibold mb-5">Invitations</h1>
  <div
    class="mt-4 px-6 py-5 flex md:justify-between md:items-center w-full border rounded-xl flex-col md:flex-row gap-y-3"
    :class="notification.read_at ? 'text-gray-500' : ''" v-for="notification in notifications">
    <div class="flex gap-1 sm:gap-6 lg:gap-12 md:items-center flex-col md:flex-row">
      <h3 class="text-xl font-semibold">{{ notification.sender.name }}</h3>
      <div>
        <div>{{ notification.sender.name }} invites you to collaborate in <span class="font=-semibold">{{
          notification.plan.name }}</span></div>
        <div class="flex gap-3 items-center mt-2">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
          </svg>
          <span>
            {{ rangePlan(notification.plan.activities) }}</span>
        </div>
      </div>
    </div>
    <PlusButton v-if="!notification.read_at" :as-link="`/dashboard/plans/${notification.plan.public_id}/join`"
      class="w-fit">Accept</PlusButton>
  </div>
  <h5 v-if="!notifications?.length" class="text-xl text-gray-600 mt-8">No invitations have been received yet</h5>
</template>