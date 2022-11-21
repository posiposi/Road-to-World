<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <!-- コメント送信失敗時のエラーメッセージ表示 -->
                <div class="alert alert-danger" v-if="error_message">
                    コメントの送信ができませんでした。時間が経ってから再送信してください。
                </div>

                <!-- コメント表示部 -->
                <div class="card">
                    <div class="card-header">
                        <div>コメント一覧</div>
                    </div>
                    <!-- ログインユーザーと自転車所有者のコメントをループ表示させる -->
                    <div class="card-body comment-view" v-for="(comments) in loginUserAndOwnerComments">
                        <!-- 表示するコメントがログインユーザーのコメントの場合 -->
                        <div v-if="comments.sender_id == data.sender.id">{{ comments.created_at }} {{ data.sender.nickname }} : {{ comments.body }}</div>
                        <!-- 表示するコメントがバイク所有者のコメントの場合 -->
                        <div v-else>{{ comments.created_at }} {{ data.receiver.nickname }} : {{ comments.body }}</div>
                    </div>
                    <div class="card-body">
                        <!-- コメント入力フォーム -->
                        <input type="text" class="form-control" v-model="comment_input" ref="comment_form">
                        <!-- 送信ボタン -->
                        <button @click="clickCommentButton" :disabled="disabled.value" ref="comment-button" class="btn btn-primary mt-2">送信</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { is } from "@babel/types";
import { computed } from "@vue/reactivity";
import axios from "axios";
import { comment } from "postcss";
import { reactive, ref, watch, onMounted } from "vue";
    export default {
        props:['data'],
        setup(props) {
            // DB内に保存されているコメント類を変数に定義する
            const data = ref(props.data);
            // コメントフォーム入力初期値の設定(初期値：ブランク)
            const comment_input = ref('');
            // ボタンの活性状態を定義(初期状態：非活性)
            const disabled = ref(true);
            // URLパラメータ取得
            let url = ref(location.pathname.substring(1).split('/'));
            // レンタル希望者コメントを用意
            let loginUserAndOwnerComments = ref();
            // エラーメッセージ表示フラグを定義(初期状態：非表示)
            const error_message = ref(false);

            /** エラーメッセージ表示メソッド */
            const showErrorMessage = () => {
                // エラーメッセージ表示フラグをON
                error_message.value = true,
                setTimeout(() => {
                    error_message.value = false
                }, 3000)
            }

            /** 既存コメントの表示 */
            const loadComment = () => {
                // 既存コメント取得APIをキックする
                axios.get('/' + url.value[0] + '/' + url.value[1] + '/' + url.value[2] + '/' + url.value[3] + '/get')
                    .then(response => loginUserAndOwnerComments.value = response.data.login_user_and_owner_comments)
                    .catch(response => console.log(response))
            }

            /** コメント保存API呼び出し */
            const postComment = () => {
                // コメント保存APIをキックする
                axios.post('/' + url.value[0] + '/' + url.value[1] + '/' + url.value[2] + '/' + url.value[3] + '/store', {
                    body: comment_input.value
                })
                .then(() => {console.log('保存通信成功')})
                // コメント保存失敗時にエラーメッセージを表示する
                .catch(() => {showErrorMessage()})
            }

            /** 送信ボタン押下時アクション */
            const clickCommentButton = () => {
                postComment(),
                setTimeout(() => loadComment(),100),
                // 入力フォームの値を空白にする
                comment_input.value = ''
            }

            /** 送信ボタンの活性切り替えを行う */
            const changeSendButtonActivity = () => {
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

            // 画面ロード時
            onMounted(() => {
                // 送信ボタン活性を切り替える
                changeSendButtonActivity(),
                // 既存コメントをロードする
                loadComment()
            })

            // コメント入力フォームを監視
            watch(comment_input, () => {
                // 送信ボタン活性を切り替える
                changeSendButtonActivity();
            })

            return {
                data,
                disabled,
                comment_input,
                changeSendButtonActivity,
                url,
                loadComment,
                loginUserAndOwnerComments,
                postComment,
                clickCommentButton,
                error_message,
                showErrorMessage,
            };
        }
    }
</script>
