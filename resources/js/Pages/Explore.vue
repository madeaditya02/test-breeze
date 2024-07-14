<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import Select from "primevue/select";
import { ref } from "vue";

defineOptions({ layout: DashboardLayout });
const provinces = ref([{
  name: 'Bali',
  name: 'Jakarta',
  name: 'Aceh',
}])
const selectedProvinces = ref(null)
</script>
<template>
  <h1 class="text-3xl font-semibold mb-5 mt-12">Recommended for You</h1>

  <Select v-model="selectedProvince" filter :options="provinces" optionLabel="name" placeholder="Select Province"
    class="w-full md:w-56" />
</template>