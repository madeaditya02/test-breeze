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
import PlaceCard from './PlaceCard.vue';
defineProps(['visible'])
const emit = defineEmits(['selected'])
const show = defineModel()
const option = ref('Search')

const searchQuery = ref('')
const searchResults = ref([])
async function searchPlace(event) {
  searchResults.value = (await axios.post('https://places.googleapis.com/v1/places:searchText', {
    textQuery: searchQuery.value
  }, {
    headers: {
      "X-Goog-Api-Key": import.meta.env.VITE_MAPS_API_KEY,
      "X-Goog-FieldMask": "*"
    }
  })).data.places
  console.log(searchResults.value);
}
const selectedPlace = ref({})
function submit() {
  emit('selected', selectedPlace.value)
  selectedPlace.value = {}
  searchQuery.value = ''
  searchResults.value = []
  show.value = false
}
</script>
<template>
  <Dialog v-model:visible="show" modal header="Select Location" :style="{ width: '36rem' }">
    <div>
      <Tabs value="0">
        <TabList>
          <Tab value="0">Search</Tab>
          <Tab value="1">Recommendations</Tab>
        </TabList>
        <TabPanels>
          <TabPanel value="0">
            <form action="" class="mb-3" @submit.prevent="searchPlace">
              <InputGroup>
                <InputText placeholder="Type name of place" v-model="searchQuery" />
                <Button label="Search" />
              </InputGroup>
            </form>
            <PlaceCard v-for="place in searchResults" :place="place" @click="() => selectedPlace = place"
              class="hover:bg-gray-100 cursor-pointer" :key="place.id"
              :class="selectedPlace.id == place.id ? 'bg-gray-100' : 'bg-white'" />
            <!-- <div class="py-4 border-b flex gap-4 hover:bg-gray-100 cursor-pointer" v-for="place in searchResults"
              @click="selectedPlace = place" :class="selectedPlace.id == place.id ? 'bg-gray-100' : 'bg-white'">
              <img :src="placePhoto(place.photos[0].name)" alt="" class="w-[160px] h-[120px] object-cover rounded-xl">
              <div class="flex-grow">
                <h3 class="text-xl font-semibold">{{ place.displayName.text }}</h3>
                <div class="flex items-center gap-2 mt-1" v-if="place.rating">
                  <span>{{ place.rating }}</span>
                  <Stars :rate="place.rating" />
                </div>
                <p class="mt-">{{ place.formattedAddress }}</p>
                <PrimaryButton :as-link="place.googleMapsUri" external class="!py-1 text-sm !rounded-md mt-1">View
                  Location
                </PrimaryButton>
              </div>
            </div> -->
          </TabPanel>
          <TabPanel value="1">
            <p class="m-0">
              Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam
              rem
              aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt
              explicabo.
              Nemo enim
              ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos
              qui ratione voluptatem sequi nesciunt. Consectetur, adipisci velit, sed quia non numquam eius modi.
            </p>
          </TabPanel>
        </TabPanels>
      </Tabs>
    </div>
    <template #footer>
      <Button class="ml-[18px]" label="Select Location" @click="submit" />
    </template>
  </Dialog>
</template>
<style>
.p-tab {
  padding-top: 0;
  padding-bottom: 10px;
}

.p-tabpanels {
  padding-right: 0;
  padding-left: 0;
}
</style>