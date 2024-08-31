<script setup>
import Button from "primevue/button";
import Dialog from "primevue/dialog";
import DatePicker from "primevue/datepicker";
import InputGroup from "primevue/inputgroup";
import { onMounted, ref, watch } from "vue";
import axios from "axios";
import Toast from "primevue/toast";
const props = defineProps(['plan'])
const visible = defineModel('visible')
const users = ref([])
onMounted(async () => {
  users.value = (await axios.post('/search-users', {})).data;
})

const endDate = ref(props.plan.end_date);
const endDateChanged = ref(false);
watch(endDate, () => {
  endDateChanged.value = true;
})

async function extendPlan() {
  axios.put(`/dashboard/plan/${props.plan.public_id}/extend`, {
    endDate: endDate.value
  }).then(() => {
    visible.value = false;
  }).catch((err) => {
    console.log(err);
  })
}

</script>
<template>
  <Toast />
  <Dialog v-model:visible="visible" modal :style="{ width: '32rem' }">

    <span class="font-medium block mb-2">Select new End Date</span>
    <InputGroup class="mb-4">
      <DatePicker :min-date="new Date(plan.end_date)" v-model="endDate" />
    </InputGroup>
    <Button label="Extend" class="" @click="extendPlan" :disabled="!endDateChanged"></Button>

  </Dialog>
</template>