<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import OutlineButton from '@/Components/OutlineButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

import { ClassicEditor, Bold, Essentials, Italic, Mention, Paragraph, Undo, BalloonEditor } from 'ckeditor5';
import MyEditor from '@/Components/MyEditor.vue';
import Popover from 'primevue/popover';
import { computed, onMounted, ref } from 'vue';
import moment from 'moment';

defineOptions({ layout: DashboardLayout });
const { plan } = defineProps(['plan'])
const sectionlist = ref();
function toggleSection(event) {
  sectionlist.value.toggle(event)
}
const title = ref(plan.name)
const body = ref('')
const sections = ref(plan.activities.map(act => ({
  ...act,
  section: false,
  title: '',
  body: ''
})))
function addSection(activity) {
  activity.section = true
  activity.title = activity.place.name
  sectionlist.value.hide()
}
function cancelSection(activity) {
  activity.section = false
  activity.title = activity.place.name
  activity.body = ''
  sectionlist.value.hide()
}

function publish() {
  const fullBody = body.value + sections.value.filter(sect => sect.section).map(sect => `<h2>${sect.title}</h2>${sect.body}`).join('')
  console.log(fullBody);
}
</script>
<template>
  <div class="flex justify-end gap-4">
    <OutlineButton>Preview</OutlineButton>
    <PrimaryButton @click="publish">Publish</PrimaryButton>
  </div>
  <div>
    <input type="text" id="title" v-model="title" class="text-4xl font-semibold block mt-10 mb-3 w-full plain-input"
      placeholder="Blog title...">
    <MyEditor v-model="body" />
    <hr>
  </div>
  <div v-for="section in sections.filter(sect => sect.section)" class="relative section">
    <input v-model="section.title" type="text" id="title"
      class="text-2xl font-semibold block mt-4 mb-3 w-full plain-input" placeholder="Section title...">
    <MyEditor v-model="section.body" />
    <hr>
    <button class="w-8 h-8 rounded-md flex justify-center items-center hover:bg-gray-100 absolute top-2 -left-8"
      @click="cancelSection(section)">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
        class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
      </svg>
    </button>
  </div>
  <a href="#" class="flex gap-1 text-blue-primary mt-4" @click="toggleSection">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
      class="size-6">
      <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
    </svg>
    <span>Add section based on activity</span>
  </a>
  <Popover ref="sectionlist">
    <div class="w-64">
      <a href="#" class="px-4 py-2.5 border-b last:border-b-0 block hover:bg-gray-50 active:bg-gray-100"
        v-for="activity in sections" @click="addSection(activity)">
        <div>{{ activity.place.name }}</div>
        <small class="text-gray-600">{{ moment.utc(activity.time).local().format('MMMM D, HH:mm') }}</small>
      </a>
    </div>
  </Popover>

</template>
<style>
.plain-input,
.plain-input:focus {
  outline: none !important;
  border: none !important;
  box-shadow: none !important;
  /* Pastikan box-shadow juga dihapus */
}
</style>