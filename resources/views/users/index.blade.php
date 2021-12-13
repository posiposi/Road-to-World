@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('/assets/css/picture.css') }}">
@endpush

@section('content')
    <div class="row">
        <h1 class="text-warning">My Page</h1>
    </div>
    <div class='container'>
        <div class="row no-gutters ml-3">
            {{-- ユーザアバター --}}
            <div class="col-md-6">
                <div class="card-body shadow-sm">
                    @if($auth->image != null)
                    <img class="card-img img-fluid" style="max-height:1080px" src="{{ $auth->image }}" alt="ユーザアバター画像">
                    @else
                    <img class="card-img img-fluid" style="max-height:1080px" src="https://bikeshare-bucket001.s3.ap-northeast-1.amazonaws.com/nc96424.jpg" alt="デフォルトアバター画像">
                    @endif
                    <div class="form-group">
                        {!! Form::open(['route' => 'users.store', 'files' => true]) !!}
                            {!! Form::file('image', ['class' => 'form-contorol-file']) !!}
                            {!! Form::submit('アバター登録', ['class' => 'btn btn-success btn-block']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
    
            {{-- ユーザ情報表示カード --}}
            <div class="col-md-6">
                <div class="card-body shadow-sm">
                    <ul class="list-group list-unstyled">
                        <li class="list-group-item"> 氏名：{{ $auth->name }} <li>
                        <li class="list-group-item"> メールアドレス：{{ $auth->email }} </li>
                        <li class="list-group-item"> 電話番号：{{ $auth->tel }} </li>
                    </ul>
                </div>
                <div class='card-body shadow-sm'>
                    {{--<ul class="list-group">
                        <li class="list-group-item col-md-6">--}}
                            {!! link_to_route('bikes.get', 'バイク登録', [], ['class' => 'btn btn-success']) !!}
                            {!! link_to_route('users.edit', 'ユーザ登録内容変更', ['id' => $auth->id], ['class' => 'btn btn-success'],) !!}
                </div>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="row ml-3">
            <h1 class="text-primary">あなたが貸し出し中の自転車</h1>
        </div>
        <div class="row no-gutters ml-3">
            @foreach ($bikes as $bike)
                @if($bike->user_id == $auth->id)
                    <div class="col-md-6 mt-3 mb-3">
                        <img class="card-img img-fluid" src="{{ $bike->image_path }}" alt="自転車画像">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body shadow-sm">
                            <ul class="list-group list-unstyled border border-dark">
                                <li class='list-group-item'> 所有者：{{ $bike->user->name }}</li>
                                <li class="list-group-item"> ブランド：{{ $bike->brand }} <li>
                                <li class="list-group-item"> モデル名：{{ $bike->name }} </li>
                                <li class="list-group-item"> 保管状態：{{ $bike->status }} </li>
                                <li class="list-group-item"> 引き渡し場所：{{ $bike->bike_address }} </li>
                                <li class="list-group-item">
                                    {!! link_to_route('bikes.edit', '登録内容変更', ['id' => $bike->id], ['class' => 'btn btn-success'],) !!}
                                    {!! Form::open(['route' => ['bikes.delete', $bike->id], 'method' => 'delete']) !!}
                                        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                    {{--{!! link_to_route('bikes.delete', '削除', ['id' => $bike->id], ['class' => 'btn btn-danger'], ['method' => 'delete'],) !!}--}}
                                </li>
                            </ul>
                        </div> 
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection