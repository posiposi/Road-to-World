@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
@endpush

@section('content')
<div class="container">
    <div class=" row text-center my-4">
        <h1>ログイン</h1>
    </div>

    {{-- 入力フォーム --}}
    <div class="row">
        <div class="col-sm-6 offset-sm-3">
            <form action="{{ route('login.post') }}" method="post">
                @csrf
                <div>
                    <label for="email">メールアドレス</label>
                    <input class="form-control" name="email" type="email">
                </div>
                <div>
                    <label for="password">パスワード</label>
                    <input class="form-control" name="password" type="password">
                </div>
                <input class="d-block login-btn btn mx-auto mt-5 rounded-pill" type="submit" value="ログイン">
                <p class="text-center">
                    <a href="{{ route('signup.get') }}" id="register_account">アカウントを作成する</a>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection