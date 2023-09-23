<div class="col-md-6">
    <h2>コメント</h2>
    <input id="input-message" type="text" class="form-control">
    <button id="btn-message-send" class="btn btn-primary mt-2" disabled>送信</button>
    <ul id="list-block">
    </ul>
</div>
@vite('resources/ts/sendMessage.ts')
@vite('resources/ts/getMessage.ts')
@vite('resources/ts/comment.ts')