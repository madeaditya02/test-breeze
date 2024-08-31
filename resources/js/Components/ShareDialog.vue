<script setup>
import Button from "primevue/button";
import Dialog from "primevue/dialog";
import InputText from "primevue/inputtext";
import AutoComplete from "primevue/autocomplete";
import InputGroup from "primevue/inputgroup";
import { computed, onMounted, ref } from "vue";
import axios from "axios";
import { useToast } from "primevue/usetoast";
import Toast from "primevue/toast";
import { usePage } from "@inertiajs/vue3";
const props = defineProps(['plan', 'onlineUsers'])
const { props: { auth } } = usePage()
const visible = defineModel('visible')
const users = ref([])
const filteredUsers = ref([])
const selectedUser = ref(null)
async function search(event) {
  // filteredUsers.value = users.value.filter(user => user.name.toLowerCase().includes(event.query.toLowerCase()))
  filteredUsers.value = (await axios.get(`/search-users?q=${event.query.toLowerCase()}`)).data
}
const toast = useToast();
async function inviteUser() {
  const res = await axios.post(`/dashboard/plans/${props.plan.public_id}/invite`, { user: selectedUser.value.id });
  if (res.status == 200)
    toast.add({ severity: 'success', summary: 'Invite Friend', detail: 'Invitation successfully sended', life: 4000 });
  selectedUser.value = null
}

const onlineUsers = computed(() => props.onlineUsers ? props.onlineUsers.map(user => user.id) : [])
const isOwner = computed(() => {
  return props.plan.users.filter(user => user.pivot.role == 'Owner')[0].id == auth.user.id
})
</script>
<template>
  <Toast />
  <Dialog v-model:visible="visible" modal :header="isOwner ? 'Invite Friends' : 'Team Members'"
    :style="{ width: '32rem' }">
    <div class="flex flex-col gap-4 w-full">
      <div v-if="isOwner">
        <span class="font-medium block mb-2">Invite Member</span>
        <InputGroup>
          <AutoComplete v-model="selectedUser" optionLabel="email" :suggestions="filteredUsers" @complete="search"
            class="focus:!border-blue-primary">
            <template #option="slotProps">
              <div class="flex items-center gap-2">
                <img :src="slotProps.option.profile_picture" class="w-8 h-8 rounded-full" />
                <div>
                  <span class="font-medium">{{ slotProps.option.name }}</span>
                  <div class="text-sm text-surface-500 dark:text-surface-400">{{ slotProps.option.email }}</div>
                </div>
              </div>
            </template>
          </AutoComplete>
          <Button label="Invite" class="" @click="inviteUser"></Button>
        </InputGroup>
      </div>
      <div>
        <span class="font-medium block mb-2" v-if="isOwner">Team Members</span>
        <ul class="list-none p-0 m-0 flex flex-col gap-4">
          <li v-for="user in plan.users" :key="user.id" class="flex items-center gap-2 justify-between">
            <div class="flex items-center gap-2">
              <div class="w-10 h-10 relative">
                <img :src="user.profile_picture" class="rounded-full w-10 h-10" />
                <div v-if="onlineUsers.includes(user.id)"
                  class="w-2.5 h-2.5 rounded-full bg-green-500 absolute top-0 right-0"></div>
              </div>
              <div>
                <span class="font-medium">{{ user.name }}</span>
                <div class="text-sm text-surface-500 dark:text-surface-400">{{ user.email }}</div>
              </div>
              <!-- <div class="flex items-center gap-2 text-surface-500 dark:text-surface-400 ml-auto text-sm">
                          <span>{{ member.role }}</span>
                          <i class="pi pi-angle-down"></i>
                      </div> -->
            </div>
            <span>{{ user.pivot.role }}</span>
          </li>
        </ul>
      </div>
    </div>
  </Dialog>
</template>