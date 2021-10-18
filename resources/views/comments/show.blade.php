@extends('layouts.app')

@section('content')
    @foreach ($bikes as $bike)
    <div class="container">
        <div class="row">
            <h1>{{ $bike->name }} の予約コメントページ</h1>
        </div>
    @endforeach
        <div class="border border-dark card mt-3 mb-3" style="max-width: 1080px">
            <div class="row no-gutters ml-3">
                @foreach ($bikes as $bike)
                    <div class="col-md-6 mt-3 mb-3">
                        <img class="card-img img-fluid" src="{{ $bike->image_path }}" alt="自転車画像">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <ul class="list-group list-unstyled border border-dark">
                                <li class='list-group-item'> 所有者：{{ $bike->user->name }}</li>
                                <li class="list-group-item"> ブランド：{{ $bike->brand }} <li>
                                <li class="list-group-item"> モデル名：{{ $bike->name }} </li>
                                <li class="list-group-item"> 保管状態：{{ $bike->status }} </li>
                                <li class="list-group-item"> 引き渡し場所：{{ $bike->bike_address }} </li>
                            </ul>
                            <ul class="list-group list-unstyled border border-dark mt-3">
                                {!! Form::open(['route' => ['bikes.reservation', $bike->id]]) !!}
                                    <li class="list-group-item">開始時間　<input type="date" name="start_date"><input type="time" class="ml-1" name="start_time"></li>
                                    <li class="list-group-item">終了時間　<input type="date" name="end_date"><input type="time" class="ml-1" name="end_time"></li>
                                    {!! Form::submit('予約', ['class' => 'btn btn-success btn-block']) !!}
                                {!! Form::close() !!}
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    {{-- コメント投稿フォーム --}}
    {!! Form::open(['route' => ['comments.store', 'id' => $bike->id]]) !!}
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-9">
                    {!! Form::text('body', null, ['class' => 'form-control']) !!}
                </div>
                <div class="col-md-3">
                    {!! Form::submit('投稿', ['class' => 'btn btn-primary btn-block']) !!}
                </div>
            </div>
        </div>
    {!! Form::close() !!}
    {{-- コメント表示部
    
    @foreach ($user_comment as $comment)
    <div class="row">
        <div class="col-md-12">
        </div>
    </div>
    @endforeach --}}
@endsection