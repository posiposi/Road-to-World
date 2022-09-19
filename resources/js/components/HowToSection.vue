<template>
    <div v-for="(images) in ImagesForHowTo">
        {{ images }}
    </div>
</template>

<script>
import axios from "axios";
import { reactive, ref, watch, onMounted } from "vue";
    export default{
        props:['data'],
        setup(props) {
            const data = ref(props.data);
            // 説明部画像を初期化し、設定する。
            let ImagesForHowTo = ref([]);

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
                getImagesForHowTo
            };
        }
    }
</script>