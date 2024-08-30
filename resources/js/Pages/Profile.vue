<script setup>
import OutlineButton from '@/Components/OutlineButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Accordion from 'primevue/accordion';
import AccordionPanel from 'primevue/accordionpanel';
import AccordionHeader from 'primevue/accordionheader';
import AccordionContent from 'primevue/accordioncontent';
import { Link, router, usePage } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import moment from 'moment';
import { debounce, numFormat } from '@/util';
import { onMounted, ref } from 'vue';
import Button from 'primevue/button';
import axios from 'axios';
import Dialog from 'primevue/dialog';
import FollowButton from '@/Components/FollowButton.vue';

defineOptions({ layout: GuestLayout })
const props = defineProps(['user', 'followed'])
const { props: { auth: { user: loggedUser } } } = usePage()
// const followed = ref(props.followed)
// const reqFollow = debounce(async () => {
//   await axios.post(`/users/${props.user.id}/follow`, { follow: followed.value })
// }, 500)
// function follow() {
//   if (!loggedUser)
//     return router.visit('/login')
//   followed.value = !followed.value
//   reqFollow()
// }
const followers = ref([])
const followersCount = ref(0)
const following = ref([])
const followingCount = ref(0)
// async function getFollower() {
//   return (await axios.post(`/users/${props.user.id}/follower`)).data
// }
async function refreshFollower() {
  followers.value = (await axios.post(`/users/${props.user.id}/follower`)).data
  followersCount.value = followers.value.length
}
// async function getFollowing() {
//   return (await axios.post(`/users/${props.user.id}/following`)).data
// }
async function refreshFollowing() {
  following.value = (await axios.post(`/users/${props.user.id}/following`)).data
  followingCount.value = following.value.length
}
const isShowFollower = ref(true)
const isShowFollowing = ref(true)
const showModal = ref(false)
onMounted(async () => {
  refreshFollower()
  refreshFollowing()
})
async function showFollower() {
  isShowFollower.value = true
  showModal.value = true
  refreshFollower()
}
function showFollowing() {
  isShowFollower.value = false
  showModal.value = true
  refreshFollowing()
}
</script>
<template>
  <div class="mt-8 md:mt-12 px-8 lg:px-44 pb-10">
    <div class="lg:px-20 sm:py-10 lg:py-14 rounded-md sm:border">
      <div class="flex justify-between flex-wrap gap-y-3">
        <div class="user inline-flex gap-x-8 gap-y-3 flex-wrap">
          <a href="#">
            <img :src="'/img/profil.jpg'" alt="" class="w-20 sm:w-[120px] h-20 sm:h-[120px] rounded-full border"
              loading="lazy">
          </a>
          <div>
            <a href="#" class="inline-block font-medium text-2xl sm:text-3xl">{{ user.name }}</a>
            <a href="#" class="block text-gray-600 text-lg sm:text-xl mt-1.5">@{{ user.username }}</a>
            <div class="flex gap-6 mt-3 items-center text-lg">
              <a href="#recent-posts"><span class="font-medium">{{ numFormat(user.stories.length) }}</span> stories</a>
              <a href="#" @click.prevent="showFollower"><span class="font-medium">{{ numFormat(followersCount) }}</span>
                followers</a>
              <a href="#" @click.prevent="showFollowing"><span class="font-medium">{{ numFormat(followingCount)
                  }}</span>
                following</a>
            </div>
          </div>
        </div>
        <div>
          <FollowButton :followed="followed" :user="user" @follow-change="f => followersCount += f ? 1 : -1" />
          <PrimaryButton v-if="user.id == loggedUser?.id" as-link="/dashboard/profile-settings">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
            </svg>
            Edit Profile
          </PrimaryButton>
        </div>
      </div>
      <h2 class="text-2xl font-semibold mt-8 mb-4 scroll-mt-24" id="recent-posts">Recent Posts</h2>
      <hr>
      <div class="py-6 border-b" v-for="story in user.stories">
        <!-- <Link href="#" class="user inline-flex gap-4 items-center">
        <img src="/img/profil.jpg" alt="" class="w-12 h-12 rounded-full" loading="lazy">
        <div>
          <h4 class="font-medium">{{user.name}}</h4>
          <p class="text-gray-600">{{user.username}}</p>
        </div>
        </Link> -->
        <div class="content grid grid-cols-1 md:grid-cols-12 gap-4 w-full">
          <div class="md:col-span-8">
            <Link :href="`/stories/${story.slug}`" class="text-2xl font-semibold hover:underline">{{ story.title }}
            </Link>
            <div class="mb-1 text-gray-600">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="inline size-4 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
              </svg>
              <span class="text-sm">{{ moment.utc(story.created_at).local().format('LL') }}</span>
            </div>
            <Link :href="`/stories/${story.slug}`" class="text-gray-600">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio nulla molestiae impedit quidem dolores
            suscipit ipsum provident vero ratione quasi temporibus autem explicabo porro, fuga quae vel delectus culpa
            obcaecati?
            </Link>
          </div>
          <Link :href="`/stories/${story.slug}`" class="md:col-span-4 h-fit">
          <img v-if="story.picture" :src="story.picture" alt=""
            class="w-full h-40 object-cover object-center rounded-lg" loading="lazy">
          </Link>
        </div>
      </div>
    </div>
  </div>

  <Dialog v-model:visible="showModal" modal :header="isShowFollower ? 'Follower' : 'Following'"
    :style="{ width: '25rem' }">
    <div class="flex justify-between items-center mt-3 first:mt-0 flex-wrap gap-y-2"
      v-for="user in (isShowFollower ? followers : following)">
      <Link :href="`/@${user.user.username}`" class="user flex gap-2 items-center">
      <img :src="user.user.profile_picture" alt="" class="w-12 h-12 rounded-full" loading="lazy">
      <div>
        <h4 class="font-medium">{{ user.user.name }}</h4>
        <p class="text-gray-600 text-sm">@{{ user.user.username }}</p>
      </div>
      </Link>
      <div>
        <FollowButton :user="user.user" :followed="user.followed"
          @follow-change="f => f ? followingCount++ : followingCount--" />
      </div>
    </div>
    <h4 class="text-center text-gray-600 my-3" v-if="(isShowFollower ? followers : following).length == 0">No {{
      isShowFollower ? 'Follower' : 'Following' }} yet</h4>
  </Dialog>
</template>