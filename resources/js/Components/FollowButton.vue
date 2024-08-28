<script setup>
import { debounce } from '@/util';
import { usePage } from '@inertiajs/vue3';
import axios from 'axios';
import Button from 'primevue/button';
import { ref } from 'vue';

const props = defineProps(['user', 'followed'])
const emit = defineEmits(['followChange'])
const { props: { auth: { user: loggedUser } } } = usePage()
const followed = ref(props.followed)
const reqFollow = debounce(async () => {
  await axios.post(`/users/${props.user.id}/follow`, { follow: followed.value })
}, 500)
function follow() {
  if (!loggedUser)
    return router.visit('/login')
  followed.value = !followed.value
  reqFollow()
  emit('followChange', followed.value)
}

</script>
<template>
  <Button v-if="user.id != loggedUser?.id" :outlined="followed" @click="follow">{{ followed ? 'Following' :
    'Follow' }}</Button>
</template>