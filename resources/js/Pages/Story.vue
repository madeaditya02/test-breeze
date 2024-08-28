<script setup>
import { Link, router, usePage } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import moment from 'moment';
import IconButton from '@/Components/IconButton.vue';
import { ref } from 'vue';
import Popover from 'primevue/popover';
import ConfirmDialog from 'primevue/confirmdialog';
import { useConfirm } from 'primevue/useconfirm';
import 'ckeditor5/ckeditor5.css';

defineOptions({ layout: GuestLayout })
const { story, preview } = defineProps(['story', 'preview'])
const { props: { auth: { user: loggedUser } } } = usePage()
const op = ref()
const confirm = useConfirm();
const confirmDelete = () => {
  confirm.require({
    message: 'Do you want to delete this story?',
    header: 'Delete Story',
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
      router.delete(`/dashboard/stories/${story.id}`)
    },
    reject: () => {
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
  <div class="pt-8 pb-8 md:px-16 lg:px-72">
    <div class="flex flex-col-reverse md:flex-col gap-y-6">
      <img v-if="story.picture" :src="story.picture" alt=""
        class="w-full h-[15rem] md:h-[24rem] object-cover object-center">
      <div class="px-4">
        <h1 class="text-4xl font-semibold text-center">{{ story.title }}</h1>
        <div class="flex justify-center gap-5 mt-5 items-center flex-wrap sm:flex-nowrap">
          <Link :href="!preview ? `/@${story.user.username}` : '#'" class="user flex gap-2 items-center">
          <img :src="story.user.profile_picture" alt="" class="w-10 h-10 sm:w-14 sm:h-14 rounded-full" loading="lazy">
          <h4 class="font-medium sm:text-xl text-gray-800">{{ story.user.name }}</h4>
          </Link>
          <span class="text-gray-600 text-3xl font-extralight hidden sm:block">|</span>
          <div class="text-gray-600 sm:text-xl">{{ moment.utc(story.created_at).local().format('MMMM D, YYYY') }}</div>
          <IconButton @click="event => $refs.op.toggle(event)" v-if="!preview && loggedUser?.id == story.user.id">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
            </svg>
          </IconButton>
          <Popover ref="op" v-if="!preview && loggedUser?.id == story.user.id">
            <button class="px-4 py-3 hover:bg-gray-100 flex items-center gap-2 rounded" @click="confirmDelete">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
              </svg>
              Delete Story
            </button>
          </Popover>
        </div>
      </div>
    </div>
    <div class="mt-8 text-xl leading-8 px-4 story prose" ref="header" v-html="story.body">
    </div>
  </div>
</template>
<style>
.prose h2 {
  margin-top: 36px;
  margin-bottom: 8px;
}

.prose figure {
  margin-top: 8px;
  margin-left: auto;
  margin-right: auto;
}

.p-popover-content {
  --p-popover-content-padding: 0;
}

figcaption {
  text-align: center;
}
</style>