@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>ユーザ登録情報変更</h1>
    </div>
    <div class="container">    
        <div class="row">
            <div class="col-sm-6 offset-sm-3">
                {!! Form::open(['route' => ['users.update', 'id'=>$auth->id], 'method' => 'put', ]) !!}
                    <div class="form-group">
                        {!! Form::label('name', '氏名') !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>
    
                    <div class="form-group">
                        {!! Form::label('email', 'メールアドレス') !!}
                        {!! Form::email('email', null, ['class' => 'form-control']) !!}
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('tel', '電話番号') !!}
                        {!! Form::number('tel', null, ['class' => 'form-control'])!!}
                    </div>
    
                    <div class="form-group">
                        {!! Form::label('password', 'パスワード') !!}
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                    </div>
    
                    {{--<div class="form-group">
                        {!! Form::label('password_confirmation', 'パスワード確認') !!}
                        {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                    </div>--}}
    
                    {!! Form::submit('変更', ['class' => 'btn btn-success btn-block']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection