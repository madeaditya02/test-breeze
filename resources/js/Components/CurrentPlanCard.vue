<script setup>
import PencilSquareIconButton from "@/Components/PencilSquareIconButton.vue";
import ShareIconButton from "@/Components/ShareIconButton.vue";
import StatusBadge from "./StatusBadge.vue";
import Popover from "primevue/popover";
import { computed, ref } from "vue";
import moment from "moment";
import { humanizeFromNow, placePhoto, rangePlan } from "@/util";
import { Link } from "@inertiajs/vue3";
const { plan } = defineProps(['plan'])
defineEmits(['sharePlan'])
const planAction = ref()
function showPlanAction(event) {
  planAction.value.toggle(event)
}
const currentActivities = computed(() => {
  if (plan.activities.length) {
    return plan.activities.filter(act => moment.utc(act.time).isSameOrAfter(moment())).slice(0, 2);
  }
  return []
});
</script>
<template>
  <div class="w-full border rounded-xl px-6 py-5 flex flex-col md:flex-row gap-8 h-full">
    <Link :href="`/dashboard/plans/${plan.public_id}`" v-if="currentActivities.length">
    <img :src="placePhoto(currentActivities[0].place.photo)" alt="" class="w-[250px] h-[170px] rounded-xl object-cover">
    </Link>
    <div class="flex-grow grid grid-cols-1 md:grid-cols-[auto_min-content] h-fit">
      <div class="flex items-start justify-between gap-4">
        <Link :href="`/dashboard/plans/${plan.public_id}`" class="text-2xl font-semibold hover:underline">{{ plan.name
        }}</Link>
        <button @click="showPlanAction" class="sm:hidden">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="size-7">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
          </svg>
        </button>
        <Popover ref="planAction">
          <div class="flex">
            <pencil-square-icon-button :as-link="`/dashboard/plans/${plan.public_id}`" />
            <share-icon-button @share="$emit('sharePlan')" />
          </div>
        </Popover>
        <!-- <StatusBadge status="On Going" /> -->
      </div>
      <div class="hidden md:flex gap-3">
        <pencil-square-icon-button :as-link="`/dashboard/plans/${plan.public_id}`" />
        <share-icon-button @share="$emit('sharePlan')" />
      </div>
      <div>
        <div class="flex gap-3 mt-2 items-center">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
          </svg>
          <span>{{ rangePlan(plan, 'MMM D, Y') }}</span>
        </div>
        <div v-if="!currentActivities?.length" class="mt-3 text-gray-600">No current activities here</div>
        <div
          class="grid grid-cols-[min-content_auto] md:grid-cols-[min-content_auto_16px_auto] gap-x-3 gap-y-1 md:gap-y-2 mt-4 items-center">
          <template v-for="activity in currentActivities">
            <div class="w-[10px] h-[10px] rounded-full"
              :class="moment.utc(activity.time).isSame(moment.utc(), 'day') ? 'bg-[#73E77F]' : 'bg-[#FAFD7B]'"></div>
            <div class="flex gap-2 items-center">
              <div>{{ activity.place.name }}</div>
            </div>
            <div></div>
            <div>{{ moment.utc(activity.time).local().format('HH:mm') }}, {{ humanizeFromNow(activity.time) }}</div>
          </template>
        </div>
      </div>
    </div>
  </div>
</template>