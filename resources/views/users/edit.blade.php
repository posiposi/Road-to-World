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
                    <label for="name">氏名</label>
                    <input class="form-control" name="name" type="text" value="{{ old('name', $login_user->name) }}">
                </div>

                <div class="mb-3">
                    <label for="nickname">ニックネーム</label>
                    <input class="form-control" name="nickname" type="text"
                        value="{{ old('nickname', $login_user->nickname) }}">
                </div>

                <div class="mb-3">
                    <label for="email">メールアドレス</label>
                    <input class="form-control" name="email" type="email"
                        value="{{ old('email', $login_user->email) }}">
                </div>

                <div class="mb-3">
                    <label for="tel">電話番号</label>
                    <input class="form-control" name="tel" type="tel" value="{{ old('tel', $login_user->tel) }}">
                </div>

                <div class="mb-3">
                    <label for="password">パスワード</label>
                    <input class="form-control" name="password" type="password" placeholder="新しいパスワードを8文字以上で設定して下さい。">
                </div>
                <input class="btn btn-success btn-change" type="submit" value="変更">
            </form>
        </div>
    </div>
</div>
@endsection