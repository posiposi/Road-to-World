@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/css/user_register.css') }}">
@endpush

@section('content')
<div class="container">
    <div class="text-center my-4">
        <h1>ユーザー登録</h1>
    </div>

    <div class="row">
        <div class="col-sm-6 offset-sm-3">
            <form action="{{ route('signup.post') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div>
                    <i class="fas fa-exclamation-circle"></i>{{ Word::WORD_LIST['required_content'] }}
                </div>
                <div class="mt-3">
                    <i class="fas fa-exclamation-circle"></i>
                    <label for="name">氏名</label>
                    <input class="form-control" type="text" name="name">
                </div>
                <div class="mt-3">
                    <i class="fas fa-exclamation-circle"></i>
                    <label for="nickname">ニックネーム</label>
                    <input class="form-control" type="text" name="nickname">
                </div>
                <div class="mt-3">
                    <i class="fas fa-exclamation-circle"></i>
                    <label for="email">メールアドレス</label>
                    <input class="form-control" type="email" name="email">
                </div>
                <div class="mt-3">
                    <i class="fas fa-exclamation-circle"></i>
                    <label for="tel">電話番号</label>
                    <input class="form-control" type="tel" name="tel" placeholder="ハイフン無し、半角数字で入力してください。">
                </div>
                <div class="mt-3">
                    <i class="fas fa-exclamation-circle"></i>
                    <label for="password">パスワード</label>
                    <input class="form-control" type="password" name="password" placeholder="8文字以上で入力して下さい。">
                </div>
                <div class="mt-3">
                    <i class="fas fa-exclamation-circle"></i>
                    <label for="password_confirmation">パスワード確認</label>
                    <input class="form-control" type="password" name="password_confirmation">
                </div>
                <input class="btn user-register-btn rounded-pill mt-3" type="submit" value="登録">
            </form>
        </div>
    </div>
</div>
@endsection