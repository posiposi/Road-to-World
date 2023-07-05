@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/css/user_edit.css') }}">
@endpush

@section('content')
<div class="text-center my-4">
    <h1>会員情報変更</h1>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-6 offset-sm-3">
            <form action="{{ route('users.update') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3" style="text-align: center">
                    <img class="avatar-img img-fluid rounded-circle" src="{{ $login_user->image }}" alt="アバター画像">
                    <label class="avatarBtnLabel">
                        ファイルを選択
                        <input type="file" class="avatarHiddenBtn" style="display: none;" name="image">
                    </label>
                </div>

                <div class="mb-3">
                    {{ Form::label('name', '氏名') }}
                    {{ Form::text('name', old('name', $login_user->name), ['class' => 'form-control']) }}
                </div>

                <div class="mb-3">
                    {{ Form::label('nickname', 'ニックネーム') }}
                    {{ Form::text('nickname', old('nickname', $login_user->nickname), ['class' => 'form-control']) }}
                </div>

                <div class="mb-3">
                    {{ Form::label('email', 'メールアドレス') }}
                    {{ Form::email('email', old('email', $login_user->email), ['class' => 'form-control']) }}
                </div>

                <div class="mb-3">
                    {{ Form::label('tel', '電話番号') }}
                    {{ Form::text('tel', old('tel', $login_user->tel), ['class' => 'form-control'])}}
                </div>

                <div class="mb-3">
                    {{ Form::label('password', 'パスワード') }}
                    {{ Form::password('password', ['class' => 'form-control', 'placeholder' =>
                    '新しく設定したいパスワードを8文字以上で入力して下さい。']) }}
                </div>
                {{ Form::submit('変更', ['class' => 'btn btn-success btn-change']) }}
            </form>
        </div>
    </div>
</div>
@endsection