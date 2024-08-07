<script setup>
import DestinationCard from "@/Components/DestinationCard.vue";
import DestinationTypeIcon from "@/Components/DestinationTypeIcon.vue";
import ExistingPlanModal from "@/Components/ExistingPlanModal.vue";
import NewPlanModal from "@/Components/NewPlanModal.vue";
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import IconField from "primevue/iconfield";
import InputIcon from "primevue/inputicon";
import InputText from "primevue/inputtext";
import MultiSelect from "primevue/multiselect";
import Select from "primevue/select";
import { ref } from "vue";

defineOptions({ layout: DashboardLayout });
const provinces = ref([
  { name: 'Bali' },
  { name: 'Jakarta' },
  { name: 'Aceh' },
])
const selectedProvince = ref(null)

const filterType = ref();
const countries = ref([
  // { name: 'All', icon: 'all' },
  { name: 'Beach', icon: 'beach' },
  { name: 'Lake & River', icon: 'lake' },
  { name: 'Landmark', icon: 'landmark' },
]);
const search = ref('');
const showModal = ref(false);
const showNewPlanModal = ref(false);
</script>
<template>
  <h1 class="text-3xl font-semibold mb-5">Explore Indonesia</h1>
  <div class="flex gap-6 flex-col md:flex-row">
    <IconField>
      <InputIcon>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
          class="size-5 -mt-[3px]">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
        </svg>
      </InputIcon>
      <InputText v-model="search" placeholder="Search" class="w-full md:w-auto" />
    </IconField>
    <Select v-model="selectedProvince" filter :options="provinces" optionLabel="name" placeholder="Select Province"
      class="w-full md:w-56" />
    <MultiSelect v-model="filterType" :options="countries" optionLabel="name" placeholder="Filter" display="chip"
      class="w-full md:w-56">
      <template #option="slotProps">
        <div class="flex items-center">
          <DestinationTypeIcon :icon="slotProps.option.icon" />
          <div>{{ slotProps.option.name }}</div>
        </div>
      </template>
    </MultiSelect>
  </div>
  <div class="mt-3 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <DestinationCard v-for="i in 12" @show-modal="showModal = true" @show-new-plan-modal="showNewPlanModal = true" />
  </div>

  <ExistingPlanModal v-model:show="showModal" />
  <NewPlanModal v-model:show="showNewPlanModal" />
</template>