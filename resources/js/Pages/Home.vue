<script setup>
import OutlineButton from '@/Components/OutlineButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Accordion from 'primevue/accordion';
import AccordionPanel from 'primevue/accordionpanel';
import AccordionHeader from 'primevue/accordionheader';
import AccordionContent from 'primevue/accordioncontent';
import { Link, usePage } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';

defineOptions({ layout: GuestLayout })
</script>
<template>
  <div id="hero"
    class="relative rounded-2xl mt-14 md:mx-[120px] bg-[url('/img/hero-view.jpg')] bg-cover bg-no-repeat bg-center text-white before:content-[''] before:block before:absolute before:z-0 before:w-full before:h-full before:bg-[rgba(0,0,0,0.5)] before:rounded-2xl">
    <div class="relative p-8 md:p-16 z-10">
      <div class="w-[640px] max-w-full">
        <h2 class="text-3xl md:text-5xl font-semibold mb-5 leading-snug">Your guide to plan your trip and explore around
          Indonesia
        </h2>
        <p>Get started to start your trip in Indonesia</p>
        <a href="#" class="px-4 py-2 rounded-lg border border-white inline-flex gap-2.5 items-center mt-5">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
          </svg>
          Start your trip
        </a>
      </div>
    </div>
  </div>

  <div id="features" class="mt-14 mx-6 md:mx-[120px] text-center">
    <h2 class="text-5xl font-semibold">Features</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 mt-5 gap-x-5">
      <div class="flex flex-col gap-2.5 justify-center items-center p-5">
        <div class="size-16 flex justify-center items-center bg-[rgba(0,0,0,0.1)] rounded-full">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-7">
            <path fill-rule="evenodd"
              d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM6.262 6.072a8.25 8.25 0 1 0 10.562-.766 4.5 4.5 0 0 1-1.318 1.357L14.25 7.5l.165.33a.809.809 0 0 1-1.086 1.085l-.604-.302a1.125 1.125 0 0 0-1.298.21l-.132.131c-.439.44-.439 1.152 0 1.591l.296.296c.256.257.622.374.98.314l1.17-.195c.323-.054.654.036.905.245l1.33 1.108c.32.267.46.694.358 1.1a8.7 8.7 0 0 1-2.288 4.04l-.723.724a1.125 1.125 0 0 1-1.298.21l-.153-.076a1.125 1.125 0 0 1-.622-1.006v-1.089c0-.298-.119-.585-.33-.796l-1.347-1.347a1.125 1.125 0 0 1-.21-1.298L9.75 12l-1.64-1.64a6 6 0 0 1-1.676-3.257l-.172-1.03Z"
              clip-rule="evenodd" />
          </svg>
        </div>
        <h3 class="text-3xl font-medium">Explore</h3>
        <p>Explore and search place that you want</p>
      </div>
      <div class="flex flex-col gap-2.5 justify-center items-center p-5">
        <div class="size-16 flex justify-center items-center bg-[rgba(0,0,0,0.1)] rounded-full">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="size-7">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
          </svg>
        </div>
        <h3 class="text-3xl font-medium">Planner</h3>
        <p>Plan your trip and note your activities</p>
      </div>
      <div class="flex flex-col gap-2.5 justify-center items-center p-5">
        <div class="size-16 flex justify-center items-center bg-[rgba(0,0,0,0.1)] rounded-full">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="size-7">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
          </svg>
        </div>
        <h3 class="text-3xl font-medium">Story</h3>
        <p>Write and share your story about your trip</p>
      </div>
    </div>
  </div>

  <div id="destinations"
    class="mx-6 md:mx-[120px] grid grid-cols-1 md:grid-cols-12 grid-rows-[220px_220px] gap-x-12 gap-y-6 mt-14">
    <div
      class="md:col-span-5 md:row-span-2 relative rounded-[20px] bg-[url('/img/bali.jpg')] bg-cover bg-center text-white before:content-[''] before:block before:absolute before:z-0 before:w-full before:h-full before:bg-[rgba(0,0,0,0.3)] before:rounded-[20px]">
      <div class="flex flex-col justify-end px-12 py-20 relative z-10 w-full h-full">
        <h3 class="font-semibold text-5xl">Bali</h3>
        <div class="flex gap-4 items-center mt-2.5">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
          </svg>
          <span class="font-medium text-xl">5.000.000+ Destinations</span>
        </div>
      </div>
    </div>
    <div
      class="md:col-span-7 relative rounded-[20px] bg-[url('/img/raja-ampat.jpg')] bg-cover bg-center text-white before:content-[''] before:block before:absolute before:z-0 before:w-full before:h-full before:bg-[rgba(0,0,0,0.3)] before:rounded-[20px]">
      <div class="flex flex-col justify-end px-12 py-16 relative z-10 w-full h-full">
        <h3 class="font-semibold text-5xl">Papua</h3>
        <div class="flex gap-4 items-center mt-2.5">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
          </svg>
          <span class="font-medium text-xl">5.000.000+ Destinations</span>
        </div>
      </div>
    </div>
    <div
      class="md:col-span-7 relative rounded-[20px] bg-[url('/img/view-2.jpg')] bg-cover bg-center text-white before:content-[''] before:block before:absolute before:z-0 before:w-full before:h-full before:bg-[rgba(0,0,0,0.3)] before:rounded-[20px]">
      <div class="flex flex-col justify-end px-12 py-16 relative z-10 size-full">
        <h3 class="font-semibold text-5xl">Sulawesi</h3>
        <div class="flex gap-4 items-center mt-2.5">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
          </svg>
          <span class="font-medium text-xl">5.000.000+ Destinations</span>
        </div>
      </div>
    </div>
  </div>

  <div id="how" class="mt-14 mx-6 md:mx-[120px] flex flex-col md:flex-row gap-2.5 mx-">
    <div class="w-full md:w-1/2">
      <h2 class="text-3xl font-semibold mb-4">How we works?</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut</p>
      <Accordion value="0">
        <AccordionPanel value="0">
          <AccordionHeader>
            <div class="flex gap-4 items-center">
              <div class="size-5 rounded-full bg-blue-primary"></div>
              <div class="text-2xl font-medium text-black">Explore Destination</div>
            </div>
          </AccordionHeader>
          <AccordionContent>
            <div class="grid gap-4 grid-cols-[20px_auto]">
              <div class="h-full flex justify-center">
                <div class="w-px bg-blue-primary h-full"></div>
              </div>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                incididunt ut labore et dolore magna aliqua.</p>
            </div>
          </AccordionContent>
        </AccordionPanel>
        <AccordionPanel value="1">
          <AccordionHeader>
            <div class="flex gap-4 items-center">
              <div class="size-5 rounded-full bg-blue-primary"></div>
              <div class="text-2xl font-medium text-black">Create your plan</div>
            </div>
          </AccordionHeader>
          <AccordionContent>
            <div class="grid gap-4 grid-cols-[20px_auto]">
              <div class="h-full flex justify-center">
                <div class="w-px bg-blue-primary h-full"></div>
              </div>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                incididunt ut labore et dolore magna aliqua.</p>
            </div>
          </AccordionContent>
        </AccordionPanel>
        <AccordionPanel value="2">
          <AccordionHeader>
            <div class="flex gap-4 items-center">
              <div class="size-5 rounded-full bg-blue-primary"></div>
              <div class="text-2xl font-medium text-black">Start your trip</div>
            </div>
          </AccordionHeader>
          <AccordionContent>
            <div class="grid gap-4 grid-cols-[20px_auto]">
              <div class="h-full flex justify-center">
                <div class="w-px bg-blue-primary h-full"></div>
              </div>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                incididunt ut labore et dolore magna aliqua.</p>
            </div>
          </AccordionContent>
        </AccordionPanel>
        <template #expandicon>
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="size-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
          </svg>
        </template>
        <template #collapseicon>
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="size-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
          </svg>
        </template>
      </Accordion>
    </div>
    <img src="/img/view-3.jpg" alt="" class="hidden md:block w-full md:w-1/2 h-[350px] rounded-2xl">
  </div>

  <div id="how" class="mt-20 mx-8 md:mx-[120px] flex flex-col md:flex-row items-center gap-2.5 justify-center">
    <img src="img/explore-ai.png" alt="" class="hidden md:block md:w-1/2 h-[350px] rounded-2xl object-cover">
    <div class="sm:w-fit text-center md:text-left">
      <h2 class="text-3xl sm:text-4xl font-semibold mb-2">AI based<br>Recommendations</h2>
      <div class="flex items-center gap-4">
      </div>
      <p class="text-lg sm:text-xl font-semibold">Integrated with</p>
      <img src="img/gemini.png" class="w-48 mx-auto sm:w-72 md:mx-0 mt-4 md:mt-0" alt="">
    </div>
  </div>

  <div id="story" class="mt-24 mx-6 md:mx-[120px] flex flex-col md:flex-row gap-x-4">
    <img src="/img/write-story2.jpg" alt="" class="w-full md:w-1/2 h-[240px] md:h-[360px] rounded-2xl object-cover">
    <div class="w-full md:w-1/2 md:pl-12">
      <h2 class="text-2xl md:text-4xl font-semibold mb-4 mt-8">Write your Trip Story</h2>
      <p class="md:text-lg">
        Back from your trip? Share the exciting stories, unforgettable moments, and valuable lessons you learned during
        your trip. Capture the beautiful moments of your trip in writing. Write on our blog and inspire others to
        explore
        the world!
      </p>
      <ul class="mt-2 md:text-lg">
        <li class="flex gap-2 items-center mt-3">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 text-green-500">
            <path fill-rule="evenodd"
              d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
              clip-rule="evenodd" />
          </svg>
          Write with our pwerfull editor
        </li>
        <li class="flex gap-2 items-center mt-3">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 text-green-500">
            <path fill-rule="evenodd"
              d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
              clip-rule="evenodd" />
          </svg>
          Integrated with AI assistant
        </li>
      </ul>
    </div>
  </div>

  <div id="join"
    class="relative rounded-2xl mt-14 mx-6 md:mx-[120px] bg-[url('/img/beach-2.jpg')] bg-cover bg-no-repeat bg-center text-white before:content-[''] before:block before:absolute before:z-0 before:w-full before:h-full before:bg-[rgba(0,0,0,0.5)] before:rounded-2xl">
    <div class="relative p-8 md:p-16 z-10">
      <div class="w-[640px] max-w-full">
        <h2 class="text-3xl md:text-5xl font-semibold mb-5 leading-snug">Ready to join and start your trip in Indonesia?
        </h2>
        <p>Discover the simplest way to plan your trip in Indonesia</p>
        <div class="flex gap-5 items-center">
          <Link href="/login"
            class="px-4 py-2 rounded-lg border border-white bg-white text-black inline-flex gap-2.5 justify-center items-center w-48 mt-5">
          Join Now
          </Link>
        </div>
      </div>
    </div>
  </div>

  <footer class="grid grid-cols-2 md:grid-cols-5 px-8 md:px-32 py-8 md:py-14 mt-12 bg-gray-200 text-black gap-y-6">
    <div class="col-span-2">
      <Link href="/" class="text-3xl font-semibold inline-block md:mb-4">
      <img src="img/Logo2.png" class="w-32 md:w-48" alt="">
      </Link>
      <div>&copy; 2024</div>
    </div>
    <!-- <div></div> -->
    <div class="hidden md:block"></div>
    <div>
      <h3 class="font-medium text-lg mb-5">Our App</h3>
      <ul>
        <li class="mb-4">
          <Link href="/dashboard">Home</Link>
        </li>
        <li class="mb-4">
          <Link href="/explore">Destination</Link>
        </li>
        <li class="mb-4">
          <Link href="/stories">Story</Link>
        </li>
        <li class="mb-4">
          <Link href="/dashboard/plans">Planner</Link>
        </li>
      </ul>
    </div>
    <!-- <div>
      <h3 class="font-medium text-lg mb-5">Company</h3>
      <ul>
        <li class="mb-4"><a href="#">FAQ</a></li>
        <li class="mb-4"><a href="#">About Us</a></li>
        <li class="mb-4"><a href="#">Privacy Policy</a></li>
        <li class="mb-4"><a href="#">Terms of Services</a></li>
      </ul>
    </div> -->
    <div>
      <h3 class="font-medium text-lg mb-5">Authentication</h3>
      <ul>
        <li class="mb-4">
          <Link href="/login">Log In</Link>
        </li>
        <li class="mb-4">
          <Link href="/register">Sign Up</Link>
        </li>
      </ul>
    </div>
  </footer>
</template>
<style>
.p-accordionheader,
.p-accordioncontent-content {
  padding-left: 0 !important;
}

.p-accordionheader {
  padding-top: 16px !important;
  padding-bottom: 8px !important;
}

.p-accordionpanel {
  --p-accordion-panel-border-width: 0px;
}
</style>