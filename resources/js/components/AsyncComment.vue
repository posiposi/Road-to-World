<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div>{{ data.sender.nickname }}のコメント</div>
                    </div>
                    <!-- ログインユーザー側コメント表示部 -->
                    <div class="card-body comment-view">
                        <!-- jQueryに記載されている内容を転載する -->
                    </div>
                    <div class="card-body">
                        <!-- 入力フォーム -->
                            <input type="text" class="form-control" v-model="comment_input">
                        <!-- 送信ボタン -->
                            <button v-bind:disabled="disabled.value" ref="comment-button" class="comment-post btn btn-primary mt-2">送信</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
// TODO 実装後に不要なimportは削除する
import { is } from "@babel/types";
import { computed } from "@vue/reactivity";
import { reactive, ref, watch, onMounted } from "vue";
    export default {
        props:['data'],
        setup(props) {
            const data = ref(props.data);
            console.log(props.data);

            const comment_input = ref('');

            //ボタンの活性状態を定義(初期状態：非活性)
            const disabled = ref(true);

            /**
             * 送信ボタンの活性切り替えを行う
             */
            const Active = function(){
                if(comment_input.value == ''){
                    disabled.value = ref(true);
                    console.log(comment_input.value);
                }else{
                    disabled.value = ref(false);
                    console.log(comment_input.value);
                }
            }

            //画面ロード時に送信ボタンを非活性化する
            onMounted(() => {
                console.log('Component mounted.'),
                Active();
            })

            //コメント入力フォームを監視
            watch(comment_input, () => {
                Active();
                console.log(comment_input.value);
            })

            return {
                data,
                disabled,
                comment_input,
                Active
            };
        }
    }
</script>    
