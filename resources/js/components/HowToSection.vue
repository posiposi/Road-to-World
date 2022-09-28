<template>
    <section>
        <div class="container">
            <div class="row">
                <div class="bg-warning py-4">
                    <section class="how_to_title">
                        <div class="row mb-4">
                            <div class="col-md-8 mb-3">
                                <h3 class="headline font-weight-bold ml-2">ご利用方法</h3>
                            </div>
                        </div>
                        <div class="row mx-2">
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div v-for="(message) in Messages">
                                            <h4 class="card-title">{{ message.id }} {{ message.text }}</h4>
                                            <div v-for="(image) in ImagesForHowTo" :key="image.id">
                                                <img :src=image alt="画像" class="card-img-bottom">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import axios from "axios";
import { reactive, ref, watch, onMounted } from "vue";
    export default{
        props:['data'],
        setup(props) {
            const data = ref(props.data);
            // 使用方法エリアの画像を初期化し、設定する
            let ImagesForHowTo = ref();
            // 使用方法エリアで使用するテキストを設定する
            let Messages = ref([
                {id: 1, text: '一覧から探す'},
                {id: 2, text: '登録内容を確認する'},
                {id: 3, text: '予約確定'},
                {id: 4, text: '自転車をレンタル'},
                {id: 5, text: '自転車を返却'}
            ]);

            const getImagesForHowTo = () => {
                axios.get('/' + 'service/' + 'show')
                .then(response => ImagesForHowTo.value = response.data.how_to_images)
                .catch(response => console.log('画像取得エラー'))
            }

            // 画面ロード時
            onMounted(() => {
                // 使用方法説明部の画像を取得する
                getImagesForHowTo();
            })

            return {
                data,
                ImagesForHowTo,
                getImagesForHowTo,
                Messages
            };
        }
    }
</script>