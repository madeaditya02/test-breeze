<script setup>
import { upFirstLetter } from '@/util';
import { Link } from '@inertiajs/vue3';
import moment from 'moment';

defineProps(['story'])

</script>
<template>
  <div class="py-6 border-b">
    <Link :href="`/@${story.user.username}`" class="user inline-flex gap-4 items-center">
    <img :src="story.user.profile_picture" alt="" class="w-12 h-12 rounded-full" loading="lazy">
    <div>
      <h4 class="font-medium">{{ story.user.name }}</h4>
      <p class="text-gray-600">@{{ story.user.username }}</p>
    </div>
    </Link>
    <div class="content grid grid-cols-1 md:grid-cols-12 gap-4 w-full">
      <div class="md:col-span-7">
        <Link :href="`/stories/${story.slug}`" class="text-2xl font-semibold hover:underline">Trip to Bali</Link>
        <div class="mb-1 text-gray-600">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="inline size-4 mr-2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
          </svg>
          <span class="text-sm">{{ upFirstLetter(moment.utc(story.created_at).fromNow()) }}</span>
        </div>
        <Link :href="`/stories/${story.slug}`" class="text-gray-600">
        {{ story.body.replace(/<[^>]+>/g, '').substring(0, 250) + "..." }}
          </Link>
      </div>
      <Link :href="`/stories/${story.slug}`" class="md:col-span-5 h-fit">
      <img v-if="story.picture" :src="story.picture" alt="" class="w-full h-40 object-cover object-center rounded-lg"
        loading="lazy">
      </Link>
    </div>
  </div>
</template>