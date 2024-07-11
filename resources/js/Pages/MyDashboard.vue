<template>
  <h1 class="text-3xl font-semibold mb-5">My Plans</h1>
  <button class="px-3 py-2 rounded-lg bg-blue-primary text-white">Add New Plan</button>
  <swiper :slidesPerView="'auto'" :spaceBetween="20" :pagination="{
    clickable: true,
  }" class="mySwiper">
    <swiper-slide>
      <div class="w-full border rounded-xl px-6 py-5 flex gap-8 mt-4">
        <img src="/img/beach.jpg" alt="" class="w-[250px] min-h-[120px] h-full rounded-xl">
        <div class="flex-grow flex gap-8">
          <div>
            <h2 class="text-2xl font-semibold">Trip to Bali</h2>
            <div class="grid gap-x-6 gap-y-4 mt-4" style="grid-template-columns: auto auto;">
              <div class="flex gap-2 items-center">
                <div class="w-[10px] h-[10px] rounded-full bg-[#73E77F]"></div>
                <div>Pantai Mertasari</div>
              </div>
              <div>16:00, Today</div>
              <div class="flex gap-2 items-center">
                <div class="w-[10px] h-[10px] rounded-full bg-[#73E77F]"></div>
                <div>Pantai Mertasari</div>
              </div>
              <div>19:00, Tommorrow</div>
            </div>
          </div>
        </div>
      </div>
    </swiper-slide>
    <swiper-slide>
      <div class="w-full border rounded-xl px-6 py-5 flex gap-8 mt-4">
        <img src="/img/beach.jpg" alt="" class="w-[250px] min-h-[120px] h-full rounded-xl">
        <div class="flex-grow flex gap-8">
          <div>
            <h2 class="text-2xl font-semibold">Trip to Bali</h2>
            <div class="grid gap-x-6 gap-y-4 mt-4" style="grid-template-columns: auto auto;">
              <div class="flex gap-2 items-center">
                <div class="w-[10px] h-[10px] rounded-full bg-[#73E77F]"></div>
                <div>Pantai Mertasari</div>
              </div>
              <div>16:00, Today</div>
              <div class="flex gap-2 items-center">
                <div class="w-[10px] h-[10px] rounded-full bg-[#73E77F]"></div>
                <div>Pantai Mertasari</div>
              </div>
              <div>19:00, Tommorrow</div>
            </div>
          </div>
        </div>
      </div>
    </swiper-slide>
    <swiper-slide>
      <div class="w-full border rounded-xl px-6 py-5 flex gap-8 mt-4">
        <img src="/img/beach.jpg" alt="" class="w-[250px] min-h-[120px] h-full rounded-xl">
        <div class="flex-grow flex gap-8">
          <div>
            <h2 class="text-2xl font-semibold">Trip to Bali</h2>
            <div class="grid gap-x-6 gap-y-4 mt-4" style="grid-template-columns: auto auto;">
              <div class="flex gap-2 items-center">
                <div class="w-[10px] h-[10px] rounded-full bg-[#73E77F]"></div>
                <div>Pantai Mertasari</div>
              </div>
              <div>16:00, Today</div>
              <div class="flex gap-2 items-center">
                <div class="w-[10px] h-[10px] rounded-full bg-[#73E77F]"></div>
                <div>Pantai Mertasari</div>
              </div>
              <div>19:00, Tommorrow</div>
            </div>
          </div>
        </div>
      </div>
    </swiper-slide>
  </swiper>
  <div class="card mt-5 w-full">
    <!-- <Carousel :value="products" :numVisible="1" :numScroll="2">
      <template #item="slotProps">
        <div class="border border-surface-200 dark:border-surface-700 rounded-md m-2 p-3 w-full">
          <div class="mb-3">
            <div class="relative mx-auto w-full">
              <img :src="'https://primefaces.org/cdn/primevue/images/product/' + slotProps.data.image"
                :alt="slotProps.data.name" class="w-full rounded-md h-[200px] object-cover" />
              <Tag :value="slotProps.data.inventoryStatus" :severity="getSeverity(slotProps.data.inventoryStatus)"
                class="absolute" style="left:5px; top: 5px" />
            </div>
          </div>
          <div class="mb-3 font-medium">{{ slotProps.data.name }}</div>
          <div class="flex justify-between items-center">
            <div class="mt-0 font-semibold text-xl">${{ slotProps.data.price }}</div>
            <span>
              <Button icon="pi pi-heart" severity="secondary" outlined />
              <Button icon="pi pi-shopping-cart" class="ml-2" />
            </span>
          </div>
        </div>
      </template>
</Carousel> -->
  </div>
</template>
<script setup>
import { ref, onMounted } from "vue";
import { Swiper, SwiperSlide } from "swiper/vue";
import 'swiper/css';

import 'swiper/css/pagination';

// import './style.css';

// import required modules
import { Pagination } from 'swiper/modules';
import DashboardLayout from '../Layouts/DashboardLayout.vue'

defineOptions({ layout: DashboardLayout })
const modules = ref([Pagination])
// const swp = useSwiper();
// const onSwiper = (swiper) => {
//   console.log(swiper);
// }
// return {onSwiper}
</script>
<style>
.swiper {
  width: 100%;
  height: auto;
}

.swiper-slide {
  /* text-align: center;
  font-size: 18px;
  background: #fff;
  border: 1px solid #000;
  display: flex;
  justify-content: center;
  align-items: center; */
}

/* .swiper-slide img {
  display: block;
  width: 100%;
  height: 100%;
  object-fit: cover;
} */
/* .swiper-slide:last-child>div {
  width: calc(100% - 20px);
} */

.swiper-slide {
  width: 80%;
}

.swiper-slide:last-child {
  width: 100%;
}

/* .swiper-slide:nth-child() {
  width: 100%;
} */

.swiper-slide:nth-child(3) {
  width: 80%;
}
</style>
<!-- <script setup>
import { ref, onMounted, onUnmounted } from "vue";
// import { ProductService } from '@/service/ProductService';
import Carousel from 'primevue/carousel';
import Button from 'primevue/button';
import Tag from 'primevue/tag';
import DashboardLayout from '../Layouts/DashboardLayout.vue'

defineOptions({ layout: DashboardLayout })
const products = ref();
onMounted(() => {
  // ProductService.getProductsSmall().then((data) => (products.value = data.slice(0, 9)));
  products.value = [{
    id: '1000',
    code: 'f230fh0g3',
    name: 'Bamboo Watch',
    description: 'Product Description',
    image: 'bamboo-watch.jpg',
    price: 65,
    category: 'Accessories',
    quantity: 24,
    inventoryStatus: 'INSTOCK',
    rating: 5
  }, {
    id: '1001',
    code: 'f230fh0g3',
    name: 'Bamboo Watch',
    description: 'Product Description',
    image: 'bamboo-watch.jpg',
    price: 65,
    category: 'Accessories',
    quantity: 24,
    inventoryStatus: 'INSTOCK',
    rating: 5
  }];
  // document.querySelector('.p-carousel-next-button')
})
onUnmounted(() => {
  document.querySelector('.p-carousel-next-button')
})
const responsiveOptions = ref([
  {
    breakpoint: '1400px',
    numVisible: 2,
    numScroll: 1
  },
  {
    breakpoint: '1199px',
    numVisible: 3,
    numScroll: 1
  },
  {
    breakpoint: '767px',
    numVisible: 2,
    numScroll: 1
  },
  {
    breakpoint: '575px',
    numVisible: 1,
    numScroll: 1
  }
]);

const getSeverity = (status) => {
  switch (status) {
    case 'INSTOCK':
      return 'success';

    case 'LOWSTOCK':
      return 'warning';

    case 'OUTOFSTOCK':
      return 'danger';

    default:
      return null;
  }
};
</script> -->
