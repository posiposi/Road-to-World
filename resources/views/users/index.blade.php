@extends('layouts.app')

@section('content')
    <div class="row text-warning">
        <h1>My Page</h1>
    </div>
    <div class='container'>
        <div class="row no-gutters ml-3">
            {{-- ユーザアバター --}}
            <div class="col-md-6 mt-3">
                <div class="card-body">
                    <img class="card-img img-fluid" src="{{ $auth->image }}" alt="ユーザアバター画像">
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
                    <ul class="list-group list-unstyled border border-dark">
                        <li class="list-group-item"> 氏名：{{ $auth->name }} <li>
                        <li class="list-group-item"> メールアドレス：{{ $auth->email }} </li>
                        <li class="list-group-item"> 電話番号：{{ $auth->tel }} </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection