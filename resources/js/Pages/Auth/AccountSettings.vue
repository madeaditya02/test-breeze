<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { router, useForm, usePage } from '@inertiajs/vue3';
import Dialog from 'primevue/dialog';
import InputText from 'primevue/inputtext';
import { onMounted, onUpdated, ref } from 'vue';

// onUpdated(() => {
//   console.log(page.props);
// })

defineOptions({ layout: DashboardLayout });
const passwordForm = useForm({
  oldPassword: '',
  newPassword: '',
  newPassword_confirmation: '',
  type: 'change-password'
})
const deleteAccount = ref(false);
const deleteForm = useForm({
  verify: '',
  password: '',
  type: 'delete-account'
})

function resetAll() {
  passwordForm.reset()
  deleteForm.reset()
  deleteAccount.value = false
}
</script>
<template>
  <form action="" @submit.prevent="passwordForm.post('', { onSuccess: resetAll })">
    <h2 class="text-2xl mb-4">Change Password</h2>
    <hr>
    <div class="my-4">
      <label for="oldPassword">Old Password</label>
      <InputText type="password" v-model="passwordForm.oldPassword" :invalid="!!passwordForm.errors.oldPassword"
        placeholder="Enter your old password" class="block mt-2 w-[26rem] max-w-full" />
      <div v-if="passwordForm.errors.oldPassword" class="text-red-500 mt-2">{{ passwordForm.errors.oldPassword }}
      </div>
    </div>
    <div class="mb-4">
      <label for="newPassword">New Password</label>
      <InputText type="password" v-model="passwordForm.newPassword" :invalid="!!passwordForm.errors.newPassword"
        placeholder="Enter your new password" class="block mt-2 w-[26rem] max-w-full" />
      <div v-if="passwordForm.errors.newPassword" class="text-red-500 mt-2">{{ passwordForm.errors.newPassword }}
      </div>
    </div>
    <div class="mt-4 mb-4">
      <label for="confirmPassword">Password Confirmation</label>
      <InputText type="password" v-model="passwordForm.newPassword_confirmation"
        :invalid="!!passwordForm.errors.newPassword_confirmation" placeholder="Enter password confirmation"
        class="block mt-2 w-[26rem] max-w-full" />
      <div v-if="passwordForm.errors.newPassword_confirmation" class="text-red-500 mt-2">{{
        passwordForm.errors.oldPassword }}
      </div>
    </div>
    <button type="submit" class="px-2 py-1.5 text-sm rounded-md text-white bg-blue-500 hover:bg-blue-600">Change
      Password</button>
  </form>
  <div class="mt-10">
    <h2 class="text-2xl mb-4">Delete Account</h2>
    <hr>
    <p class="text-red-500 mt-4">
      Once you delete your account, there is no going back.
    </p>
    <p class="text-red-500 mt-1 mb-4">All your data in problog will be deleted permanently.</p>
  </div>
  <button @click="deleteAccount = true" class="px-2 py-1.5 rounded-md text-white bg-red-500 hover:bg-red-600">Delete
    account</button>

  <Dialog v-model:visible="deleteAccount" modal header="Delete Account" :style="{ width: '28rem' }">
    <form action="" @submit.prevent="deleteForm.post('')">
      <p class="text-red-500 mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
          class="size-5 text-red-600 inline mr-2">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
        </svg>
        This is extremely important
      </p>
      <p>We'll immediately delete your profile information and all your posts, comments and replies
        published on Problog.</p>
      <div class="mt-4 mb-4">
        <label for="verify" class="font-medium">To verify, type <em class="font-normal select-none">delete my
            account</em>
          below</label>
        <InputText type="text" v-model="deleteForm.verify" :invalid="!!deleteForm.errors.verify"
          class="block w-full mt-2" />
        <div v-if="deleteForm.errors.verify" class="text-red-500 mt-2">{{ deleteForm.errors.verify }}
        </div>
        <!-- <input required type="text"
          class="block w-full mt-2 px-3 py-2 rounded-md border focus:outline-none focus:border-blue-600" id="verify"
          :class="{ 'border-red-600 focus:border-red-600': deleteForm.errors.verify }" v-model="deleteForm.verify">
        <div class="text-red-500 mt-2" v-if="deleteForm.errors.verify">{{ deleteForm.errors.verify }}</div> -->
      </div>
      <div class="mb-4">
        <label for="verifPassword" class="font-medium">Confirm your password</label>
        <InputText type="password" v-model="deleteForm.password" :invalid="!!deleteForm.errors.password"
          class="block w-full mt-2" />
        <div v-if="deleteForm.errors.password" class="text-red-500 mt-2">{{ deleteForm.errors.password }}
        </div>
        <!-- <input required type="password"
          class="block w-full mt-2 px-3 py-2 rounded-md border focus:outline-none focus:border-blue-600"
          :class="{ 'border-red-600 focus:border-red-600': deleteForm.errors.password }" id="verifPassword"
          v-model="deleteForm.password"> -->
        <!-- <div class="text-red-500 mt-2" v-if="deleteForm.errors.password">{{ deleteForm.errors.password }}</div> -->
      </div>
      <button :disabled="deleteForm.processing"
        class="px-2 py-1.5 rounded-md text-white bg-red-500 hover:bg-red-600">Delete account</button>
    </form>
  </Dialog>
</template>