@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <h1>{{ $bikes->name }} の予約コメントページ</h1>
        </div>
        <div class="border border-dark card mt-3 mb-3" style="max-width: 1080px">
            <div class="row no-gutters ml-3">
                <div class="col-md-6 mt-3 mb-3">
                    <img class="card-img img-fluid" src="{{ $bikes->image_path }}" alt="自転車画像">
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <ul class="list-group list-unstyled border border-dark">
                            <li class='list-group-item'> 所有者：{{ $bikes->user->name }}</li>
                            <li class="list-group-item"> ブランド：{{ $bikes->brand }} <li>
                            <li class="list-group-item"> モデル名：{{ $bikes->name }} </li>
                            <li class="list-group-item"> 保管状態：{{ $bikes->status }} </li>
                            <li class="list-group-item"> 引き渡し場所：{{ $bikes->bike_address }} </li>
                        </ul>
                        <ul class="list-group list-unstyled border border-dark mt-3">
                            {!! Form::open(['route' => ['bikes.reservation', $bikes->id]]) !!}
                                <li class="list-group-item">開始時間　<input type="date" name="start_date"><input type="time" class="ml-1" name="start_time"></li>
                                <li class="list-group-item">終了時間　<input type="date" name="end_date"><input type="time" class="ml-1" name="end_time"></li>
                                {!! Form::submit('予約', ['class' => 'btn btn-success btn-block']) !!}
                            {!! Form::close() !!}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- コメント投稿フォーム --}}
    {!! Form::open(['route' => ['comments.store', 'bikeId' => $bikes->id, 'recieverId' => $bikes->user_id]]) !!}
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-9">
                    {!! Form::text('body', null, ['class' => 'form-control',]) !!}
                </div>
                <div class="col-md-3">
                    {!! Form::submit('投稿', ['class' => 'btn btn-primary btn-block']) !!}
                </div>
            </div>
        </div>
    {!! Form::close() !!}
    
    {{-- コメント表示部 --}}
    <div class="row">
        <div class="col-md-6">
            <h2>{{ $sender->name }}のコメント</h2>
            @foreach ($sender_comments as $sender_comment)
                <p>{{ $sender_comment }}</p>
            @endforeach
        </div>
        <div class="col-md-6">
            <h2>{{ $reciever->name }}のコメント</h2>
            @foreach ($reciever_comments as $reciever_comment)
                <p>{{ $reciever_comment }}</p>
            @endforeach
        </div>
    </div>
@endsection