<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div>コメント一覧</div>
                    </div>
                    <!-- ログインユーザー側コメント表示部 -->
                    <div class="card-body comment-view" v-for="(value) in sendercommentjson">
                        {{ data.sender.nickname }} : {{ value.body }}
                    </div>
                    <!-- 自転車所有ユーザー側コメント表示部 -->
                    <!-- <div class="card-body" v-for="(value) in receivercommentjson">
                        {{ data.receiver.nickname }} : {{ value.body }}
                    </div> -->
                    <div class="card-body">
                        <!-- 入力フォーム -->
                            <input type="text" class="form-control" v-model="comment_input">
                        <!-- 送信ボタン -->
                            <button @click="loadComment" :disabled="disabled.value" ref="comment-button" class="comment-post btn btn-primary mt-2">送信</button>
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
import axios from "axios";
import { reactive, ref, watch, onMounted } from "vue";
    export default {
        props:['data'],
        setup(props) {
            // DB内に保存されているコメント類を変数に定義する
            const data = ref(props.data);
            // コメントフォーム入力初期値の設定(初期値：ブランク)
            const comment_input = ref('');
            //ボタンの活性状態を定義(初期状態：非活性)
            const disabled = ref(true);
            // URLパラメータ取得
            let url = ref(location.pathname.substring(1).split('/'));

            // レンタル希望者コメントを用意
            let sendercommentjson = ref();

            /**
             * 既存コメントの表示
             */
            const loadComment = () => {
                // 既存コメント取得APIをキックする
                axios.get('/' + url.value[0] + '/' + url.value[1] + '/' + url.value[2] + '/' + url.value[3] + '/get')
                    // 予約希望者の既存コメントを定義する
                    .then(response => sendercommentjson.value = response.data.sender_allcomments)
                    .catch(response => console.log(response))
            }

            /**
             * 送信ボタンの活性切り替えを行う
             */
            const Active = () => {
                // コメント入力フォームがブランクの場合はボタン非活性
                if(comment_input.value == ''){
                    disabled.value = ref(true);
                    console.log(comment_input.value);
                // コメント入力フォームに入力がある場合はボタン活性
                }else{
                    disabled.value = ref(false);
                    console.log(comment_input.value);
                }
            }

            
            const postComment = () => {
                
            }

            //画面ロード時
            onMounted(() => {
                //送信ボタン活性を切り替える
                Active(),
                //既存コメントをロードする
                loadComment()
            })

            //コメント入力フォームを監視
            watch(comment_input, () => {
                //送信ボタン活性を切り替える
                Active();
            })

            return {
                data,
                disabled,
                comment_input,
                Active,
                url,
                loadComment,
                sendercommentjson,
            };
        }
    }
</script>    
