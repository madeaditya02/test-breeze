<script setup>
import OutlineButton from '@/Components/OutlineButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Accordion from 'primevue/accordion';
import AccordionPanel from 'primevue/accordionpanel';
import AccordionHeader from 'primevue/accordionheader';
import AccordionContent from 'primevue/accordioncontent';
import { Link, usePage } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputGroup from 'primevue/inputgroup';
import InputText from 'primevue/inputtext';
import Button from 'primevue/button';
import Stars from '@/Components/Stars.vue';
import { ref, watch } from 'vue';
import Drawer from 'primevue/drawer';
import { placePhoto } from '@/util';
import axios from 'axios';
import Loading from '@/Components/Loading.vue';
import StoryCard from '@/Components/StoryCard.vue';
import TabPanels from 'primevue/tabpanels';
import TabPanel from 'primevue/tabpanel';
import Tab from 'primevue/tab';
import Tabs from 'primevue/tabs';
import TabList from 'primevue/tablist';

defineOptions({ layout: GuestLayout })
const props = defineProps(['stories', 'followingStories', 'tab'])
const stories = ref(props.stories)
const loadingRecent = ref(false)
const followingStories = ref(props.followingStories)
const loadingFollowing = ref(false)
const page = usePage();
const user = page.props.auth.user;
const showFilter = ref(false)
const loading = ref(false)
const tab = ref(props.tab)
// watch(tab, async val => {
//   console.log(val);
//   if (val == 'following' && !followingStories.value?.length) {
//     loadingFollowing.value = true
//     followingStories.value = (await axios.get('/stories?tab=following')).data
//     loadingFollowing.value = false
//   } else if (val == 'recent' && !stories.value?.length) {
//     loadingRecent.value = true
//     stories.value = (await axios.get('/stories?tab=recent')).data
//     loadingRecent.value = false
//   }
// })
watch(tab, async val => {
  if (val == 'following' && !followingStories.value?.length) {
    loadingFollowing.value = true
    followingStories.value = (await axios.get('/stories?tab=following')).data
    loadingFollowing.value = false
  } else if (val == 'recent' && !stories.value?.length) {
    loadingRecent.value = true
    await getRecentStories()
    loadingRecent.value = false
  }
})

// Filter place
const searched = ref(false)
const search = ref('')
const places = ref([])
const loadingSearch = ref(false)
const selectedPlace = ref(null)
async function searchPlace() {
  searched.value = true
  loadingSearch.value = true
  places.value = []
  selectedPlace.value = null
  if (search.value) {
    places.value = (await axios.post('https://places.googleapis.com/v1/places:searchText', {
      textQuery: search.value
    }, {
      headers: {
        "X-Goog-Api-Key": import.meta.env.VITE_MAPS_API_KEY,
        "X-Goog-FieldMask": "*"
      }
    })).data.places
    loadingSearch.value = false
    console.log(places.value);
  } else {
    searched.value = false
  }
}
async function getRecentStories() {
  stories.value = (await axios.get('/stories?tab=recent')).data
}
async function selectPlace(place) {
  loadingRecent.value = true
  await getRecentStories()
  tab.value = 'recent'
  selectedPlace.value = place
  // stories.value = props.stories
  stories.value = stories.value.filter(story => {
    const bodyHTML = document.createElement('div')
    bodyHTML.innerHTML = story.body
    return [...bodyHTML.querySelectorAll('h2')].map(el => el.id).includes(place.id)
  });
  loadingRecent.value = false
  // stories.value = stories.value.filter(story => story.plan.activities.filter(act => act.place_id == selectedPlace.value.id).length > 0);
}
// const filteredStories = computed(() => stories.filter(story => story.plan.activities.filter(act => act.place.id == selectedPlace.id)))
</script>
<template>
  <div class="px-6 md:px-16 xl:px-28 flex flex-col lg:flex-row mt-10 mb-10">
    <div class="w-full lg:w-[60%] xl:w-[65%] lg:pr-7">
      <div class="flex justify-between items-center mb-4">
        <h1 class="text-3xl font-semibold">Trip Blogs</h1>
        <OutlineButton @click="showFilter = true" class="lg:hidden" size="sm">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
          </svg>
          Filter
        </OutlineButton>
      </div>
      <Tabs v-model:value="tab">
        <TabList v-if="user">
          <Tab value="following">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="size-5 inline mr-1">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
            Following
          </Tab>
          <Tab value="recent">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="size-5 inline mr-1">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            Recent
          </Tab>
        </TabList>
        <TabPanels>
          <TabPanel value="following" v-if="user">
            <StoryCard v-for="story in followingStories" :story="story" />
            <Loading v-if="loadingFollowing" />
            <h5 v-if="!followingStories?.length && !loadingFollowing" class="text-xl text-gray-600 mt-8">No stories have
              been published
              yet</h5>
          </TabPanel>
          <TabPanel value="recent">
            <StoryCard v-for="story in stories" :story="story" />
            <Loading v-if="loadingRecent" />
            <h5 v-if="!stories?.length && !loadingRecent" class="text-xl text-gray-600 mt-8">No stories have been
              published yet</h5>
          </TabPanel>
        </TabPanels>
      </Tabs>
      <Loading v-if="loading" />
    </div>
    <div class="w-full lg:w-[40%] xl:w-[35%] pl-7 hidden lg:block">
      <h2 class="text-2xl font-semibold mb-4">Filter by place</h2>
      <form action="" class="mb-3" @submit.prevent="searchPlace">
        <InputGroup>
          <InputText v-model="search" placeholder="Type name of place" />
          <Button type="submit">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
          </Button>
        </InputGroup>
      </form>
      <div v-if="searched" v-for="place in places" @click="selectPlace(place)"
        class="py-4 px-3 border-b flex gap-4 cursor-pointer hover:bg-gray-100"
        :class="{ 'bg-gray-100': selectedPlace?.id == place.id }">
        <img :src="placePhoto(place.photos[0].name)" alt="" class="w-[120px] h-[80px] object-cover rounded-xl">
        <div class="flex-grow">
          <h3 class="text-xl font-semibold">{{ place.displayName.text }}</h3>
          <p class="mt-1">{{ place.formattedAddress }}</p>
        </div>
      </div>
      <Loading v-if="loadingSearch" />
      <div class="text-gray-700" v-if="!searched">Search for a place and select to filter recent blogs by selected place
      </div>
    </div>
    <Drawer v-model:visible="showFilter" header="Filter by place" position="right">
      <form action="" class="mb-3" @submit.prevent="searchPlace">
        <InputGroup>
          <InputText v-model="search" placeholder="Type name of place" />
          <Button type="submit">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
          </Button>
        </InputGroup>
      </form>
      <div v-if="searched" v-for="place in places" @click="selectPlace(place)"
        class="py-4 px-3 border-b flex gap-4 cursor-pointer hover:bg-gray-100"
        :class="{ 'bg-gray-100': selectedPlace?.id == place.id }">
        <img :src="placePhoto(place.photos[0].name)" alt="" class="w-[120px] h-[80px] object-cover rounded-xl">
        <div class="flex-grow">
          <h3 class="text-xl font-semibold">{{ place.displayName.text }}</h3>
          <p class="mt-1">{{ place.formattedAddress }}</p>
        </div>
      </div>
      <Loading v-if="loadingSearch" />
      <div class="text-gray-700" v-if="!searched">Search for a place and select to filter recent blogs by selected place
      </div>
    </Drawer>
  </div>
</template>