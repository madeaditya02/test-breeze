<script setup>
import DestinationCard from "@/Components/DestinationCard.vue";
import DestinationTypeIcon from "@/Components/DestinationTypeIcon.vue";
import ExistingPlanModal from "@/Components/ExistingPlanModal.vue";
import NewPlanModal from "@/Components/NewPlanModal.vue";
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
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

const showModal = ref(false);
const showNewPlanModal = ref(false);
</script>
<template>
  <h1 class="text-3xl font-semibold mb-5">Explore Indonesia</h1>
  <div class="flex items-center gap-6">
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
  <div class="mt-3 grid grid-cols-3 gap-6">
    <DestinationCard v-for="i in 12" @show-modal="showModal = true" @show-new-plan-modal="showNewPlanModal = true" />
  </div>

  <ExistingPlanModal v-model:show="showModal" />
  <NewPlanModal v-model:show="showNewPlanModal" />
</template>