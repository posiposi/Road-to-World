@if (Auth::id() === $bike['ownerId'])
<div class="mt-2">
    <a href="{{ route('comments.index', [
    'bikeId' => $bike['bikeId'],
    'lenderId' => $bike['ownerId']
]) }}" class="btn btn-success">コメントルーム一覧へ</a>
</div>
@else
<div class="col-md-6">
    <h2>コメント</h2>
    <input id="input-message" type="text" class="form-control" placeholder="{{ Word::WORD_LIST['within_140words'] }}"
        maxlength="140" enterkeyhint=”next”>
    <button id="btn-message-send" class="btn btn-primary mt-2" disabled enterkeyhint=”send”>送信</button>
    <ul id="list-block">
    </ul>
</div>
@endif
@vite('resources/ts/sendMessage.ts')
@vite('resources/ts/getMessage.ts')
@vite('resources/ts/comment.ts')