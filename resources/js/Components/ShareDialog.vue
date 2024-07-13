<script setup>
import Button from "primevue/button";
import Dialog from "primevue/dialog";
import InputText from "primevue/inputtext";
import AutoComplete from "primevue/autocomplete";
import InputGroup from "primevue/inputgroup";
import { ref } from "vue";
const visible = defineModel('visible')
const users = ref([
  {
    name: 'Made Aditya',
    username: 'mdadityaa',
  },
  {
    name: 'Wahyu Pranata',
    username: 'yupranataa',
  },
  {
    name: 'Kadek Chandra',
    username: 'kadekchandra',
  }
])
const filteredUsers = ref([])
const selectedUser = ref('')
function search(event) {
  // filteredUsers.value = users.value
  filteredUsers.value = users.value.filter(user => user.name.toLowerCase().includes(event.query.toLowerCase()))
  // console.log(users.value);
}
</script>
<template>
  <Dialog v-model:visible="visible" modal header="Invite Friends" :style="{ width: '32rem' }">
    <div class="flex flex-col gap-4 w-full">
      <div>
        <span class="font-medium block mb-2">Invite Member</span>
        <InputGroup>
          <AutoComplete v-model="selectedUser" optionLabel="username" :suggestions="filteredUsers" @complete="search">
            <template #option="slotProps">
              <div class="flex items-center gap-2">
                <img :src="`https://primefaces.org/cdn/primevue/images/avatar/amyelsner.png`" style="width: 32px" />
                <div>
                  <span class="font-medium">{{ slotProps.option.name }}</span>
                  <div class="text-sm text-surface-500 dark:text-surface-400">{{ slotProps.option.username }}</div>
                </div>
              </div>
            </template>
          </AutoComplete>
          <Button label="Invite"></Button>
        </InputGroup>
      </div>
      <div>
        <span class="font-medium block mb-2">Team Members</span>
        <ul class="list-none p-0 m-0 flex flex-col gap-4">
          <li v-for="i in 3" :key="i" class="flex items-center gap-2">
            <img :src="`https://primefaces.org/cdn/primevue/images/avatar/amyelsner.png`" style="width: 32px" />
            <div>
              <span class="font-medium">Made Aditya</span>
              <div class="text-sm text-surface-500 dark:text-surface-400">mdadityaa</div>
            </div>
            <!-- <div class="flex items-center gap-2 text-surface-500 dark:text-surface-400 ml-auto text-sm">
                        <span>{{ member.role }}</span>
                        <i class="pi pi-angle-down"></i>
                    </div> -->
          </li>
        </ul>
      </div>
    </div>
  </Dialog>
</template>