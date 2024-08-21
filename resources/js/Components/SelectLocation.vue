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
import { GoogleGenerativeAI } from '@google/generative-ai';
import Textarea from 'primevue/textarea';

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

// AI
const prompt = ref('')
const AISearchResults = ref([])
const genAI = new GoogleGenerativeAI(import.meta.env.VITE_GEMINI_API_KEY)
const model = genAI.getGenerativeModel({ model: "gemini-1.5-flash", generationConfig: { responseMimeType: "application/json" } });
async function getAI() {
  console.log(prompt.value);
  const ourPrompt = `${prompt.value}. Provide some places (more than one) recommendations based on the prompt. Return an array of the fullname, city and regency of the place as one string.`;
  const result = await model.generateContent(ourPrompt);
  const response = await result.response;
  const text = response.text();
  const places = JSON.parse(text);
  console.log(places);
  AISearchResults.value = []
  places.forEach(async place => {
    // console.log(place);
    const res = (await axios.post('https://places.googleapis.com/v1/places:searchText', {
      textQuery: place
    }, {
      headers: {
        "X-Goog-Api-Key": import.meta.env.VITE_MAPS_API_KEY,
        "X-Goog-FieldMask": "*"
      }
    }))
    console.log(res);
    AISearchResults.value.push(res.data.places[0]);
    // return res.data.places[0]
  });
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
            <form action="" @submit.prevent="getAI">
              <Textarea name="" id="" v-model="prompt" placeholder="Describe what you want" class="block mb-3 w-full"
                rows="3" />
              <PrimaryButton>Submit</PrimaryButton>
            </form>
            <PlaceCard v-for="place in AISearchResults" :place="place" @click="() => selectedPlace = place"
              class="hover:bg-gray-100 cursor-pointer" :key="place.id"
              :class="selectedPlace.id == place.id ? 'bg-gray-100' : 'bg-white'" />
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