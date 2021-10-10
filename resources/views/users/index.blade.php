@extends('layouts.app')

@section('content')
    <div class="row">
        <h1 class="text-warning">My Page</h1>
    </div>
    <div class='container'>
        <div class="row no-gutters ml-3">
            {{-- ユーザアバター --}}
            <div class="col-md-6">
                <div class="card-body">
                    <img class="card-img img-fluid" style="max-height:1080px" src="{{ $auth->image }}" alt="ユーザアバター画像">
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
                <div class="card-body">
                    <ul class="list-group list-unstyled">
                        <li class="list-group-item"> 氏名：{{ $auth->name }} <li>
                        <li class="list-group-item"> メールアドレス：{{ $auth->email }} </li>
                        <li class="list-group-item"> 電話番号：{{ $auth->tel }} </li>
                    </ul>
                </div>
                <div class='card-body'>
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
            <h1 class="text-primary">貸出中自転車</h1>
        </div>
        <div class="row">

        </div>
    </div>
@endsection