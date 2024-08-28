<script setup>
import { ref, watch, onUnmounted } from 'vue'
import { Head, useForm, usePage } from '@inertiajs/vue3'
import axios from 'axios'
import { Cropper, CircleStencil } from 'vue-advanced-cropper'
import 'vue-advanced-cropper/dist/style.css'
import DashboardLayout from '@/Layouts/DashboardLayout.vue'
import InputText from 'primevue/inputtext'

defineOptions({ layout: DashboardLayout });
// const props = defineProps(['user'])
const { props: { auth: { user: loggedUser } } } = usePage()
const form = useForm({
  name: loggedUser.name,
  username: loggedUser.username,
  profile_picture: loggedUser.profile_picture,
  pictureFile: null
})
onUnmounted(() => console.log('Unonmounted'))

function updateProfile() {
  form.post('/dashboard/profile-settings')
}

// Image
const choosedFile = ref(null)
const fileInput = ref(null)
const cropper = ref(null)
function changeFile(event) {
  closeCropper()
  if (event.target.files[0]) {
    form.pictureFile = event.target.files[0]
    choosedFile.value = URL.createObjectURL(event.target.files[0])
    console.log(form.pictureFile)
  }
}
function crop() {
  cropper.value.getResult().canvas.toBlob((blob) => {
    console.log(blob)
    form.pictureFile = blob
    form.profile_picture = URL.createObjectURL(blob)
    closeCropper()
  })
}
function closeCropper() {
  if (choosedFile.value) {
    // console.log(choosedFile.value)
    URL.revokeObjectURL(choosedFile.value)
    choosedFile.value = null
  }
}

</script>
<template>
  <form @submit.prevent="updateProfile()">
    <div class="flex md:gap-6 lg:gap-12 flex-wrap sm:flex-nowrap">
      <!-- General -->
      <div class="sm:w-1/2">
        <h2 class="text-2xl font-semibold">General</h2>
        <div class="mt-4 mb-4">
          <label class="font-medium" for="name">Full name</label>
          <InputText v-model="form.name" type="text" placeholder="Enter your full name" :invalid="form.errors.name"
            class="block w-full mt-2" />
          <div v-if="form.errors.name" class="text-red-600 mt-1">{{ form.errors.name }}</div>
        </div>
        <div class="mt-4 mb-4">
          <label class="font-medium" for="name">Username</label>
          <InputText v-model="form.username" type="text" placeholder="Enter your username"
            :invalid="form.errors.username" class="block w-full mt-2" />
          <div v-if="form.errors.username" class="text-red-600 mt-1">{{ form.errors.username }}</div>
        </div>
        <div class="mb-4">
          <label class="font-medium" for="name">Profile Picture</label>
          <a href="#" class="relative block w-fit mt-4" @click.prevent="fileInput.click()">
            <img :src="form.profile_picture" alt="" class="w-32 md:w-48 h-32 md:h-48 rounded-full shadow-xl">
            <button type="button" class="px-2 py-1.5 rounded-md bg-white border absolute bottom-0 left-0">Edit</button>
          </a>
          <input type="file" name="pictureFile" id="pictureFile" class="hidden" @change="changeFile"
            @click="$event.target.value = null" ref="fileInput" accept="image/*">
        </div>
        <!-- <h2 class="text-2xl font-semibold mt-6">About you</h2>
        <div class="mt-4 mb-4">
          <label class="font-medium" for="bio">Bio</label>
          <textarea type="text"
            class="block w-full mt-2 px-3 py-2 rounded-md border focus:outline-none focus:border-blue-600" id="bio"
            placeholder="Enter your description" rows="4" v-model="form.bio"></textarea>
        </div> -->
        <!-- <div class="mt-4 mb-4 relative">
          <div class="absolute top-20 left-0 w-full bg-white shadow-xl z-10" v-if="searchTech">
            <a href="#" class="block px-4 py-2 hover:bg-gray-100" v-for="tech in searchTech"
              @click.prevent="addTech(tech)">{{ tech.tag }}</a>
          </div>
          <label class="font-medium" for="technologies">Tech Stack</label>
          <input class="block w-full mt-2 px-3 py-2 rounded-md border focus:outline-none focus:border-blue-600"
            id="technologies" placeholder="Search topics" v-model="tech">
          <div class="mt-3 flex gap-2 flex-wrap">
            <a href="#" @click.prevent="" class="px-2 py-1.5 rounded-md border border-blue-600 text-blue-600 text-sm"
              v-for="topic in form.tags">{{ topic.tag }}<fa-icon icon="fa-solid fa-xmark" class="ml-1.5" size="lg"
                @click="form.tags.splice(form.tags.indexOf(topic), 1);" /></a>
          </div>
        </div> -->
      </div>
      <!-- Social -->
      <div class="sm:w-1/2">

      </div>
    </div>
    <button class="inline-block mt-4 px-3 py-2 rounded-md bg-blue-600 text-white">Update
      Profile</button>

    <Transition name="fade">
      <div class="fixed inset-0 bg-[rgba(0,0,0,0.5)] py-10 px-8 z-[99]" @click="closeCropper()" v-if="choosedFile">
        <div class="w-fit bg-white rounded-md shadow-lg mx-auto" @click.stop>
          <div class="w-full p-5">
            <Cropper :src="choosedFile" :stencil-component="CircleStencil" class="h-[25rem]" imageClass="h-[25rem]"
              ref="cropper" />
          </div>
          <hr>
          <div class="px-5 py-3 flex gap-4">
            <button type="button" class="px-3 py-2 rounded-md bg-blue-600 text-white" @click="crop()">Crop
              Image</button>
            <button type="button" class="px-3 py-2 rounded-md bg-red-600 text-white"
              @click="closeCropper()">Cancel</button>
          </div>
        </div>
      </div>
    </Transition>
  </form>
</template>
<style>
.vue-advanced-cropper,
.cropper {
  /* width: 100px; */
  width: 32rem;
  /* width: 100%; */
  max-height: 500px;
  margin: auto;
  /* height: 100px; */
}

/* we will explain what these classes do next! */
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.4s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>