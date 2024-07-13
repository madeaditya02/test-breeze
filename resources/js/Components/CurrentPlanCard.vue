<script setup>
import PencilSquareIconButton from "@/Components/PencilSquareIconButton.vue";
import ShareIconButton from "@/Components/ShareIconButton.vue";
defineEmits(['sharePlan'])
</script>
<template>
  <div class="w-full border rounded-xl px-6 py-5 flex gap-8">
    <img src="/img/beach.jpg" alt="" class="w-[250px] min-h-[120px] h-full rounded-xl">
    <div class="flex-grow flex gap-4">
      <div>
        <h2 class="text-2xl font-semibold">Trip to Bali</h2>
        <div class="grid gap-x-5 gap-y-4 mt-4 items-center" style="grid-template-columns: auto auto;">
          <div class="flex gap-2 items-center">
            <div class="w-[10px] h-[10px] rounded-full bg-[#73E77F]"></div>
            <div>Pantai Mertasari</div>
          </div>
          <div>16:00, Today</div>
          <div class="flex gap-2 items-center">
            <div class="w-[10px] h-[10px] rounded-full bg-[#FAFD7B]"></div>
            <div>Pantai Sanur</div>
          </div>
          <div>19:00, Tomorrow</div>
        </div>
      </div>
      <div class="flex gap-3">
        <pencil-square-icon-button />
        <share-icon-button @share="$emit('sharePlan')" />
      </div>
    </div>
  </div>
</template>