<script setup>
import { Swiper, SwiperSlide } from 'swiper/vue';
import CurrentPlanCard from './CurrentPlanCard.vue';
import 'swiper/css';
import 'swiper/css/pagination';
defineEmits(['sharePlan', 'simple'])
</script>
<template>
  <div class="current-plan">
    <swiper :slidesPerView="'auto'" :spaceBetween="30" :pagination="{
      clickable: true,
    }">
      <swiper-slide v-for="i in 7">
        <current-plan-card @share-plan="$emit('sharePlan', i)" />
      </swiper-slide>
      <swiper-slide></swiper-slide>
    </swiper>
  </div>
</template>
<style>
.swiper {
  width: 100%;
  height: auto;
}

.current-plan .swiper-slide {
  width: 85%;
}

.current-plan .swiper-slide:last-child {
  width: calc(15% - 30px);
}
</style>