<script setup>
import IconButton from '@/Components/IconButton.vue';
import OutlineButton from '@/Components/OutlineButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Link, usePage } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';

const page = usePage();
const user = page.props.auth.user;

onMounted(() => {
  window.addEventListener('scroll', () => {
    if (window.scrollY > 0) {
      document.querySelector('.navbar').classList.add('!shadow-lg')
    } else {
      document.querySelector('.navbar').classList.remove('!shadow-lg')
    }
  })
})

const show = ref(false)

const emit = defineEmits(['back', 'publish'])
</script>
<template>
  <nav
    class="navbar flex justify-between md:items-center md:px-[120px] py-6 flex-wrap flex-col md:flex-row fixed top-0 left-0 right-0 bg-white transition-all z-10">
    <div class="w-full md:w-auto flex justify-between items-center px-8 md:px-0">
      <Link href="/" class="text-3xl font-semibold">Travel Planner</Link>
      <IconButton class="md:hidden" @click="show = !show">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
          class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
      </IconButton>
    </div>
    <!-- <div class="md:!flex gap-4 md:gap-12 md:items-center flex-col md:flex-row py-5 md:py-0 px-8 md:px-0"
      :class="show ? 'flex' : 'hidden'">
      <Link href="/">Home</Link>
      <Link href="/stories">Stories</Link>
      <Link href="#">Explore</Link>
      <Link href="#">FaQ</Link>
    </div> -->
    <div class="px-8 md:px-0 md:!block" :class="show ? 'block' : 'hidden'">
      <div class="flex items-center gap-5">
        <OutlineButton @click="$emit('back')">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
          </svg>
          Back to Edit
        </OutlineButton>
        <PrimaryButton @click="$emit('publish')">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
          </svg>
          Publish Article
        </PrimaryButton>
      </div>
    </div>
  </nav>
  <div class="pt-20">
    <slot />
  </div>
</template>
