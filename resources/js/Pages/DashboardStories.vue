<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import PlusButton from '@/Components/PlusButton.vue';
import moment from 'moment';
import OutlineButton from '@/Components/OutlineButton.vue';
import Button from 'primevue/button';
import { Link, router } from '@inertiajs/vue3';
import { useConfirm } from 'primevue/useconfirm';

defineOptions({ layout: DashboardLayout });
const props = defineProps(['stories'])
const confirm = useConfirm();
const confirmDelete = (id) => {
  confirm.require({
    message: 'Do you want to delete this story?',
    header: 'Delete Story',
    icon: 'pi pi-info-circle',
    rejectLabel: 'Cancel',
    rejectProps: {
      label: 'Cancel',
      severity: 'secondary',
      outlined: true
    },
    acceptProps: {
      label: 'Delete',
      severity: 'danger'
    },
    accept: () => {
      router.delete(`/dashboard/stories/${id}`)
    },
    reject: () => {
      // toast.add({ severity: 'error', summary: 'Rejected', detail: 'You have rejected', life: 3000 });
    }
  });
};
</script>
<template>
  <ConfirmDialog>
    <template #icon>
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
        class="size-12 text-red-600">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
      </svg>
    </template>
  </ConfirmDialog>
  <h1 class="text-3xl font-semibold mb-5">Published Stories</h1>
  <div class="py-6 flex justify-between gap-2 items-center border-b flex-wrap" v-for="story in stories">
    <div>
      <Link :href="`/stories/${story.slug}`" class="text-xl sm:text-3xl font-semibold hover:underline">{{ story.title }}
      </Link>
      <p class="text-gray-600 mt-2">Published on {{ moment.utc(story.created_at).local().format('LL') }}</p>
    </div>
    <div class="flex gap-3 sm:pr-6">
      <OutlineButton :as-link="`/stories/${story.slug}`">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
          class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
          <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
        </svg>
        View
      </OutlineButton>
      <Button @click="confirmDelete(story.id)" severity="danger">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
          class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
        </svg>
        Delete
      </Button>
    </div>
  </div>
  <h5 v-if="stories.length == 0" class="text-xl text-gray-600 mt-8">No stories have been published yet</h5>
</template>