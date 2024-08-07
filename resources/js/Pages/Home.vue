<script setup>
import OutlineButton from '@/Components/OutlineButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Accordion from 'primevue/accordion';
import AccordionPanel from 'primevue/accordionpanel';
import AccordionHeader from 'primevue/accordionheader';
import AccordionContent from 'primevue/accordioncontent';
import { Link, usePage } from '@inertiajs/vue3';

const page = usePage();
const user = page.props.auth.user;
</script>
<template>
  <nav class="flex justify-between items-center mx-[120px] pt-8">
    <Link href="/" class="text-3xl font-semibold">Travel Planner</Link>
    <div class="flex gap-12 items-center">
      <Link href="/">Home</Link>
      <Link href="#">Explore</Link>
      <Link href="#">Features</Link>
      <Link href="#">FaQ</Link>
    </div>
    <OutlineButton as-link="/dashboard" v-if="user">Dashboard</OutlineButton>
    <div class="flex items-center gap-5" v-if="!user">
      <OutlineButton as-link="/login">Log In</OutlineButton>
      <PrimaryButton as-link="/register">Sign Up</PrimaryButton>
    </div>
  </nav>

  <div id="hero"
    class="relative rounded-2xl mt-14 mx-[120px] bg-[url('/img/hero-view.jpg')] bg-cover bg-no-repeat bg-center text-white before:content-[''] before:block before:absolute before:z-0 before:w-full before:h-full before:bg-[rgba(0,0,0,0.5)] before:rounded-2xl">
    <div class="relative p-16 z-10">
      <div class="w-[640px] max-w-full">
        <h2 class="text-5xl font-semibold mb-5 leading-snug">Your guide to plan your trip and explore around Indonesia
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

  <div id="features" class="mt-14 mx-[120px] text-center">
    <h2 class="text-5xl font-semibold">Features</h2>
    <div class="grid grid-cols-3 mt-5 gap-5">
      <div class="flex flex-col gap-2.5 justify-center items-center p-5" v-for="i in 3">
        <div class="size-16 flex justify-center items-center bg-[rgba(0,0,0,0.1)] rounded-full">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="size-7">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
          </svg>
        </div>
        <h3 class="text-3xl font-medium">Features</h3>
        <p>Lorem ipsum dolor sit amet consectur sit amet</p>
      </div>
    </div>
  </div>

  <div id="destinations" class="mx-[120px] grid grid-cols-12 grid-rows-[220px_220px] gap-x-12 gap-y-6 mt-14">
    <div
      class="col-span-5 row-span-2 relative rounded-[20px] bg-[url('/img/bali.jpg')] bg-cover bg-center text-white before:content-[''] before:block before:absolute before:z-0 before:w-full before:h-full before:bg-[rgba(0,0,0,0.3)] before:rounded-[20px]">
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
      class="col-span-7 relative rounded-[20px] bg-[url('/img/raja-ampat.jpg')] bg-cover bg-center text-white before:content-[''] before:block before:absolute before:z-0 before:w-full before:h-full before:bg-[rgba(0,0,0,0.3)] before:rounded-[20px]">
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
      class="col-span-7 relative rounded-[20px] bg-[url('/img/view-2.jpg')] bg-cover bg-center text-white before:content-[''] before:block before:absolute before:z-0 before:w-full before:h-full before:bg-[rgba(0,0,0,0.3)] before:rounded-[20px]">
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

  <div id="how" class="mt-14 mx-[120px] flex gap-2.5 mx-">
    <div class="w-1/2">
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
      <!-- <div class="mt-4">
        <div class="flex gap-4 items-center">
          <div class="size-5 rounded-full bg-blue-primary"></div>
          <div class="text-2xl">Explore Destination</div>
        </div>
        <div class="flex gap-4">
          <div class="w-5 h-full flex justify-center">
            <div class="w-px bg-blue-primary h-full"></div>
          </div>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
            dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
            incididunt ut labore et dolore magna aliqua.</p>
        </div>
      </div>
      <div class="mt-4">
        <div class="flex gap-4 items-center">
          <div class="size-5 rounded-full bg-blue-primary"></div>
          <div class="text-2xl">Create your plan</div>
        </div>
      </div>
      <div class="mt-4">
        <div class="flex gap-4 items-center">
          <div class="size-5 rounded-full bg-blue-primary"></div>
          <div class="text-2xl">Start your trip</div>
        </div>
      </div> -->
    </div>
    <img src="/img/view-3.jpg" alt="" class="w-1/2 h-[350px] rounded-2xl">
  </div>

  <div id="join"
    class="relative rounded-2xl mt-14 mx-[120px] bg-[url('/img/beach-2.jpg')] bg-cover bg-no-repeat bg-center text-white before:content-[''] before:block before:absolute before:z-0 before:w-full before:h-full before:bg-[rgba(0,0,0,0.5)] before:rounded-2xl">
    <div class="relative p-16 z-10">
      <div class="w-[640px] max-w-full">
        <h2 class="text-5xl font-semibold mb-5 leading-snug">Ready to join and start your trip in Indonesia?</h2>
        <p>Discover the simplest way to plan your trip in Indonesia</p>
        <div class="flex gap-5 items-center">
          <a href="#"
            class="px-4 py-2 rounded-lg border border-white bg-white text-black inline-flex gap-2.5 justify-center items-center w-48 mt-5">
            Join Now
          </a>
          <a href="#"
            class="px-4 py-2 rounded-lg border border-white inline-flex gap-2.5 justify-center items-center w-48 mt-5">
            Learn More
          </a>
        </div>
      </div>
    </div>
  </div>

  <footer class="grid grid-cols-5 px-32 py-14 mt-12 bg-[#282727] text-white">
    <div>
      <a href="#" class="text-3xl font-semibold inline-block mb-4">Travel Planner</a>
      <div>&copy; 2024</div>
    </div>
    <div></div>
    <div>
      <h3 class="font-medium text-lg mb-5">Our App</h3>
      <ul>
        <li class="mb-4"><a href="#">Home</a></li>
        <li class="mb-4"><a href="#">Destination</a></li>
        <li class="mb-4"><a href="#">Planner</a></li>
      </ul>
    </div>
    <div>
      <h3 class="font-medium text-lg mb-5">Company</h3>
      <ul>
        <li class="mb-4"><a href="#">FAQ</a></li>
        <li class="mb-4"><a href="#">About Us</a></li>
        <li class="mb-4"><a href="#">Privacy Policy</a></li>
        <li class="mb-4"><a href="#">Terms of Services</a></li>
      </ul>
    </div>
    <div>
      <h3 class="font-medium text-lg mb-5">Authentication</h3>
      <ul>
        <li class="mb-4"><a href="#">Log In</a></li>
        <li class="mb-4"><a href="#">Sign Up</a></li>
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