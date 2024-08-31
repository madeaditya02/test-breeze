<script setup>
import PencilSquareIconButton from "@/Components/PencilSquareIconButton.vue";
import ShareIconButton from "@/Components/ShareIconButton.vue";
import StatusBadge from "./StatusBadge.vue";
import Popover from "primevue/popover";
import { computed, ref, onMounted } from "vue";
import DeletePlanButton from "./DeletePlanButton.vue";
import PrimaryButton from "./PrimaryButton.vue";
import moment from "moment";
import Rating from "primevue/rating";
import { placePhoto } from "@/util";

defineEmits(['delete', 'select-edit'])
const showEdit = ref(false);

const props = defineProps(['activity'])
const planAction = ref()
function showPlanAction(event) {
  planAction.value.toggle(event)
}
const fromNow = computed(() => {
  return moment.utc(props.activity.time).local().calendar(null, {
    sameDay: '[Today]',
    nextDay: '[Tomorrow]',
    nextWeek: 'dddd',
    lastDay: '[Yesterday]',
    lastWeek: '[Last] dddd',
    sameElse: 'DD/MM/YYYY'
  })
})
const isActive = computed(() => {
  return moment.utc(props.activity.time).isSameOrAfter(moment())
})
console.log(props.activity);

const rating = ref()
</script>
<template>
  <div class="px-6 py-5 border rounded-xl flex md:items-center gap-3 sm:gap-4 lg:gap-7 mt-4 flex-col md:flex-row">
    <img v-if="isActive" :src="placePhoto(activity.photo)" alt=""
      class="md:w-[160px] w-full h-[120px] object-cover rounded-xl">
    <div class="flex-grow">
      <div class="flex justify-between">
        <h3 class="text-xl font-semibold">{{ activity.name }}</h3>
        <button v-if="isActive" @click="showPlanAction" class="lg:hidden">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="size-7">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
          </svg>
        </button>
        <Popover v-if="isActive" ref="planAction">
          <div class="flex">
            <PencilSquareIconButton @click="() => { $emit('select-edit', activity); showEdit = true }" />
            <DeletePlanButton @delete="$emit('delete')" />
          </div>
        </Popover>
        <div v-if="isActive" class="hidden lg:flex gap-3">
          <PencilSquareIconButton @click="() => { $emit('select-edit', activity); showEdit = true }" />
          <DeletePlanButton @delete="$emit('delete')" />
        </div>
      </div>
      <div class="flex gap-2.5 items-center mt-2 mb-3">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
          class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
        <span>{{ fromNow }}, {{ moment.utc(activity.time).local().format('HH:mm') }}</span>
      </div>
      <PrimaryButton v-if="isActive" size="sm">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
          class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
        </svg>
        <span>View Location</span>
      </PrimaryButton>
    </div>
    <!-- <Rating v-if="!isActive" v-model="rating" /> -->
  </div>
</template>