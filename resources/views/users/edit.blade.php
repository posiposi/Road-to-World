@extends('layouts.app')

@section('content')
    <div class="text-center my-4">
        <h1>ユーザ登録情報変更</h1>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 offset-sm-3">
                {{ Form::open(['route' => ['users.update', 'id'=>$login_user->id], 'method' => 'put', ]) }}
                    <div class="form-group">
                        {{ Form::label('name', '氏名') }}
                        {{ Form::text('name', old('name', $login_user->name), ['class' => 'form-control']) }}
                    </div>
                    
                    <div class="form-group">
                        {{ Form::label('nickname', 'ニックネーム') }}
                        {{ Form::text('nickname', old('nickname', $login_user->nickname), ['class' => 'form-control']) }}
                    </div>
    
                    <div class="form-group">
                        {{ Form::label('email', 'メールアドレス') }}
                        {{ Form::email('email', old('email', $login_user->email), ['class' => 'form-control']) }}
                    </div>
                    
                    <div class="form-group">
                        {{ Form::label('tel', '電話番号') }}
                        {{ Form::text('tel', old('tel', $login_user->tel), ['class' => 'form-control'])}}
                    </div>
    
                    <div class="form-group">
                        {{ Form::label('password', 'パスワード') }}
                        {{ Form::password('password', ['class' => 'form-control', 'placeholder' => '新しく設定したいパスワードを8文字以上で入力して下さい。']) }}
                    </div>
    
                    {{ Form::submit('変更', ['class' => 'btn btn-success btn-block']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection