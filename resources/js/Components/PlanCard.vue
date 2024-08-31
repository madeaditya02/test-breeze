<script setup>
import PencilSquareIconButton from './PencilSquareIconButton.vue';
import ShareIconButton from './ShareIconButton.vue';
import StatusBadge from './StatusBadge.vue';
import FavoriteButton from './FavoriteButton.vue';
import DeletePlanButton from './DeletePlanButton.vue';
import PrimaryButton from './PrimaryButton.vue';
import { computed } from 'vue';
import moment from 'moment';
import { Link } from '@inertiajs/vue3';
import { humanizeFromNow, planStatus, rangePlan } from '@/util';

defineEmits(['sharePlan']);
const { plan } = defineProps(['plan'])
const rangeTime = computed(() => rangePlan(plan))
const currentActivities = computed(() => plan.activities.filter(act => moment.utc(act.time).isSameOrAfter(moment())).slice(0, 2))

</script>
<template>
  <div class="px-6 py-5 border rounded-xl flex justify-between flex-col md:flex-row">
    <div>
      <div class="flex items-center gap-4">
        <Link :href="`/dashboard/plans/${plan.public_id}`" class="text-2xl font-medium">{{ plan.name }}</Link>
        <StatusBadge :status="planStatus(plan)" />
      </div>
      <div class="flex md:items-center gap-4 mt-4 flex-col md:flex-row">
        <div class="flex gap-3 items-center">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
          </svg>
          <span>{{ rangeTime }}</span>
        </div>
        <div class="flex gap-3 items-center">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
          </svg>
          <span>{{ plan.activities.length }} Activities</span>
        </div>
      </div>
      <div class="flex items-center gap-8">
        <div class="grid gap-x-5 gap-y-3 mt-4 items-center" style="grid-template-columns: auto auto;">
          <template v-for="activity in currentActivities">
            <div class="flex gap-2 items-center">
              <div class="w-[10px] h-[10px] rounded-full bg-[#FAFD7B]"></div>
              <div>{{ activity.activity }}</div>
            </div>
            <div>{{ moment.utc(activity.time).local().format('HH:mm') }}, {{ humanizeFromNow(activity.time) }}</div>
          </template>
          <!-- <div class="flex gap-2 items-center">
            <div class="w-[10px] h-[10px] rounded-full bg-[#FAFD7B]"></div>
            <div>Pantai Sanur</div>
          </div>
          <div>19:00, Tomorrow</div> -->
        </div>
      </div>
    </div>
    <div class="text-right">
      <div class="flex gap-3 pt-2 border-t mt-3 md:pt-0 md:border-0 md:mt-0">
        <pencil-square-icon-button />
        <share-icon-button @share="$emit('sharePlan')" />
        <FavoriteButton />
        <DeletePlanButton />
      </div>
      <!-- <PrimaryButton class="mt-2.5">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
          class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
        </svg>
        <span>Rate This Trip</span>
      </PrimaryButton> -->
    </div>
  </div>
</template>