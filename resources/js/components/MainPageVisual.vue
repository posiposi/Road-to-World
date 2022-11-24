<template>
    <div class="container text-center">
      <!-- メインロゴ -->
      <div class="row">
        <img :src=welcome_logo_path>
      </div>

      <!-- カルーセル -->
      <div class="row">
        <div class="col-sm-12">
          <Carousel :wrap-around="true" v-if="Images.length !== 0">
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
        </div>
      </div>

      <!-- サイト説明文 -->
      <div class="row introduction_texts">
        <div class="col-sm-12">
          <h3>{{ texts.main_title }}</h3>
        </div>
        <div class="col-sm-12 mb-3 bg-white">
          <h4 class="mt-3">{{ texts.sub_title }}</h4>
        </div>
      </div>
    </div>
</template>

<script>
import axios from "axios";
import { reactive, ref, watch, onMounted } from "vue";
import { Carousel, Navigation, Slide, Pagination } from 'vue3-carousel';
import { defineComponent } from 'vue'

import 'vue3-carousel/dist/carousel.css';

    export default defineComponent({
        components: {Carousel, Navigation, Slide, Pagination},
        props:['data', 'welcome_logo_path'],
        setup(props) {
            // カルーセル画像
            const data = ref(props.data);
            // メインロゴのURL
            const welcome_logo_path = ref(props.welcome_logo_path);
            // 使用方法エリアの画像を初期化し、設定する
            const Images = ref([]);
            // サブタイトル、メインテキスト用変数を初期化
            const texts = ref([]);

            /**
             * S3から画像を取得する
             * 
             * @return {array} how_to_images S3に保存されている画像URL
             */
            const getImagesForHowTo = () => {
                axios.get('/' + 'service/' + 'show')
                .then(response => Images.value = response.data.how_to_images)
                .catch(response => console.log('画像取得エラー'))
            }
            
            /**
             * メインページに表示するテキストを取得する
             * 
             * @return {array} texts 表示するテキスト類
             */
            const getText = () => {
              axios.get('/' + 'service/' + 'getText')
              .then(response => texts.value = response.data.texts)
              .catch(response =>console.log('テキスト取得エラー'))
            }

            // 画面ロード時
            onMounted(() => {
                // 使用方法説明部の画像パスを取得する
                getImagesForHowTo(),
                getText()
            })

            return {
                data,
                getImagesForHowTo,
                Images,
                welcome_logo_path,
                getText,
                texts
            };
        }
    });
</script>

<style>
/* カルーセル */
.carousel__item {
  height: 420px;
  width: 1000px;
  background-color: var(--vc-clr-primary);
  color: var(--vc-clr-white);
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

/* 文字フォント */
.introduction_texts{
  font-family: "ヒラギノ明朝 Pro W3",
    "Hiragino Mincho Pro",
    "MS P明朝",
    "MS PMincho",
    serif;
}

</style>