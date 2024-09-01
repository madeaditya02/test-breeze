<script setup>
import Button from 'primevue/button';
import Dialog from 'primevue/dialog';
import InputGroup from 'primevue/inputgroup';
import InputText from 'primevue/inputtext';
import Rating from 'primevue/rating';
import Tab from 'primevue/tab';
import TabList from 'primevue/tablist';
import TabPanel from 'primevue/tabpanel';
import TabPanels from 'primevue/tabpanels';
import Tabs from 'primevue/tabs';
import { reactive, ref, watch } from 'vue';
import Stars from './Stars.vue';
import axios from 'axios';
import { placePhoto } from '@/util';
import PrimaryButton from './PrimaryButton.vue';
defineProps(['place', 'class'])
const emit = defineEmits(['click'])
</script>
<template>
  <div class="py-4 border-b flex gap-4 flex-col xs:flex-row" :class="class" @click="$emit('click')">
    <img v-if="place.photos" :src="placePhoto(place.photos[0].name)" alt=""
      class="w-full xs:!w-[160px] h-[160px] xs:h-[120px] object-cover rounded-xl">
    <div class="flex-grow">
      <h3 class="text-xl font-semibold">{{ place.displayName.text }}</h3>
      <div class="flex items-center gap-2 mt-1" v-if="place.rating">
        <span>{{ place.rating }}</span>
        <Stars :rate="place.rating" />
      </div>
      <p class="text-wrap">{{ place.formattedAddress }}</p>
      <PrimaryButton :as-link="place.googleMapsUri" external class="!py-1 text-sm !rounded-md mt-1">View
        Location
      </PrimaryButton>
    </div>
  </div>
</template>