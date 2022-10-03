<template>
  <Carousel :items-to-show="2.5" :wrap-around="true" v-if="Images.length!==0">
    <Slide v-for="slide in Images" :key="slide">
      <div class="carousel__item">
        <img :src="slide" alt="画像">
      </div>
    </Slide>

    <template #addons>
      <Navigation />
      <Pagination />
    </template>
  </Carousel>
</template>

<script>
import axios from "axios";
import { reactive, ref, watch, onMounted } from "vue";
import { Carousel, Navigation, Slide, Pagination } from 'vue3-carousel';
import { defineComponent } from 'vue'

import 'vue3-carousel/dist/carousel.css';

    export default defineComponent({
        components: {Carousel, Navigation, Slide, Pagination},
        props:['data'],
        setup(props) {
            const data = ref(props.data);
            // 使用方法エリアの画像を初期化し、設定する
            const Images = ref([]);

            const getImagesForHowTo = () => {
                axios.get('/' + 'service/' + 'show')
                .then(response => Images.value = response.data.how_to_images)
                .catch(response => console.log('画像取得エラー'))
            }

            // 画面ロード時
            onMounted(() => {
                // 使用方法説明部の画像パスを取得する
                getImagesForHowTo();
            })

            return {
                data,
                getImagesForHowTo,
                Images
            };
        }
    });
</script>

<style>
  .carousel__item {
    min-height: 200px;
    width: 100%;
    background-color: var(--vc-clr-primary);
    color:  var(--vc-clr-white);
    font-size: 20px;
    border-radius: 8px;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  
  .carousel__slide {
    padding: 10px;
  }
  
  .carousel__prev,
  .carousel__next {
    box-sizing: content-box;
    border: 5px solid white;
  }
  </style>