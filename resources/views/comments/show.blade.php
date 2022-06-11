@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('/assets/css/comments_show.css') }}">
@endpush

@section('content')

    <div class="container">
        <div class="row">
            <h1 class="mt-3">{{ $bikes->name }} の予約コメントページ</h1>
        </div>
        <div class="mt-3 mb-3" style="max-width: 1080px">
            <div class="row no-gutters ml-3">
                <div class="col-md-6 mt-3 mb-3">
                    <img class="card-img img-fluid" src="{{ $bikes->image_path }}" alt="自転車画像">
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <ul class="list-group list-unstyled">
                            <li class='list-group-item'> 所有者：{{ $bikes->user->nickname }}</li>
                            <li class="list-group-item"> ブランド：{{ $bikes->brand }} <li>
                            <li class="list-group-item"> モデル名：{{ $bikes->name }} </li>
                            <li class="list-group-item"> 保管状態：{{ $bikes->status }} </li>
                            <li class="list-group-item"> 引き渡し場所：{{ $bikes->bike_address }} </li>
                            <li class="list-group-item card-remark"> 説明・備考</br>
                                <p class="mt-2">{{ $bikes->remark }}</p>
                            </li>
                        </ul>
                        <ul class="list-group list-unstyled mt-3">
                            {{ Form::open(['route' => ['bikes.reservation', $bikes->id]]) }}
                                <li class="list-group-item">開始日　<input type="date" name="start_date"><br>
                                開始時間
                                <select name="start_time">
                                    @foreach($times as $time)
                                        <option value ="{{ $time }}">{{ $time }}</option>
                                    @endforeach
                                </select>
                                </li>
                                <li class="list-group-item">終了日　<input type="date" name="end_date"><br>
                                終了時間
                                <select name="end_time">
                                    @foreach($times as $time)
                                        <option value ="{{ $time }}">{{ $time }}</option>
                                    @endforeach
                                </select>
                                </li>
                                {{ Form::submit('予約', ['class' => 'btn btn-success btn-block mt-2']) }}
                            {{ Form::close() }}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- コメント投稿フォーム --}}
    {{-- {{ Form::open(['route' => ['comments.store', 'bikeId' => $bikes->id, 'senderId' => $sender->id, 'receiverId' => $receiver->id]]) }}
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-9">
                    {{ Form::text('body', null, ['class' => 'form-control comment-body']) }}
                </div>
                <div class="col-md-3">
                    {{ Form::submit('投稿', ['class' => 'btn btn-primary btn-block comment-post']) }}
                </div>
            </div>
        </div>
    {{ Form::close() }} --}}
    
    {{-- コメント表示部 --}}
    {{-- <div class="row my-3">
        <div class="col-md-6">
            <h2>{{ $sender->nickname }}のコメント</h2>
            @foreach ($sender_comments as $sender_comment)
                <p id="comment-view">{{ $sender_comment }}</p>
            @endforeach
        </div>
        <div class="col-md-6">
            <h2>{{ $receiver->nickname }}のコメント</h2>
            @foreach ($receiver_comments as $receiver_comment)
                <p>{{ $receiver_comment }}</p>
            @endforeach
        </div>
    </div> --}}

    {{-- 非同期通信コメント表示部分 --}}
    <div class="chat-container row justify-content-center">
        {{-- ログイン中ユーザーのコメント表示部分 --}}
        <div class="col-md-6 chat-area">
            <div class="card">
                <div class="card-header">{{ $sender->nickname }}のComment</div>
                <div class="card-body chat-card">
                    <div class="comment-view"></div>
                </div>
                <div class="card-body">
                    <input type="text" id="comment-form" class="comment-body">
                    <button id="comment-button" class="comment-post">送信</button>
                </div>
            </div>
        </div>
        {{-- 相手側コメント表示部分 --}}
        <div class="col-md-6 chat-area">
            <div class="card">
                <div class="card-header">{{ $receiver->nickname }}のComment</div>
                <div class="card-body chat-card">
                    <div class="comment-view"></div>
                </div>
                <div class="card-body">
                    <input type="text" id="comment-form" class="comment-body">
                    <button id="comment-button" class="comment-post">送信</button>
                </div>
            </div>
        </div>
    </div>
    
    <script src="{{ mix('js/comment.js') }}"></script>
@endsection