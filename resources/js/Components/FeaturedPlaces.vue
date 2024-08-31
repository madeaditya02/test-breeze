<script setup>
import DestinationCard from "@/Components/DestinationCard.vue";
import ExistingPlanModal from "@/Components/ExistingPlanModal.vue";
import Loading from "@/Components/Loading.vue";
import NewPlanModal from "@/Components/NewPlanModal.vue";
import { GoogleGenerativeAI } from "@google/generative-ai";
import axios from "axios";
import { onMounted, ref } from "vue";

const { provinces, count, countMany } = defineProps(['provinces', 'count', 'countMany'])
const showModal = ref(false);
const showNewPlanModal = ref(false);

const genAI = new GoogleGenerativeAI(import.meta.env.VITE_GEMINI_API_KEY)
const model = genAI.getGenerativeModel({ model: "gemini-1.5-flash", generationConfig: { responseMimeType: "application/json" } });

const featuredPlacesName = ref([])
const featuredPlaces = ref([])
const loading = ref(false)
const currentIndex = ref(0)
async function loadMorePlaces() {
  if (currentIndex.value >= featuredPlacesName.value.length) return
  console.log('Load more');
  loading.value = true
  const loadedNames = featuredPlacesName.value.slice(currentIndex.value, currentIndex.value + 6)
  loadedNames.forEach(async place => {
    const res = (await axios.post('https://places.googleapis.com/v1/places:searchText', {
      textQuery: place.fullname,
    }, {
      headers: {
        "X-Goog-Api-Key": import.meta.env.VITE_MAPS_API_KEY,
        "X-Goog-FieldMask": "*"
      }
    }))
    featuredPlaces.value.push({ ...res.data.places[0], short_description: place.short_description })
    console.log(res);
  })
  currentIndex.value += 6
  loading.value = false
}

onMounted(async () => {
  loading.value = true
  const ourPrompt = `${provinces?.length > 1 ? (count ?? 20) : (countMany ?? 40)}+ places hidden gem in ${provinces?.length ? provinces.join(', ') : 'Indonesia'}. Return as one array (fullname and short_description)`;
  const result = await model.generateContent(ourPrompt);
  const response = await result.response;
  const text = JSON.parse(response.text());
  featuredPlacesName.value = text
  console.log(text);
  await loadMorePlaces()
  const observer = new IntersectionObserver(entries => entries.forEach(entry => {
    if (entry.isIntersecting && !loading.value) loadMorePlaces()
  }), {
    rootMargin: "-150px 0px 0px 0px"
  })
  observer.observe(document.querySelector('.loadMoreIntersect'))
})
</script>
<template>
  <div v-if="featuredPlaces.length > 0" class="mt-3 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
    <DestinationCard v-for="place in featuredPlaces" :place="place" @show-modal="showModal = true"
      @show-new-plan-modal="showNewPlanModal = true" />
  </div>
  <Loading v-if="loading" />
  <span class="loadMoreIntersect"></span>

  <ExistingPlanModal v-model:show="showModal" />
  <NewPlanModal v-model:show="showNewPlanModal" />
</template>