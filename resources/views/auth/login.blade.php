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
            {{ Form::open(['route' => 'login.post']) }}
            <div>
                {{ Form::label('email', 'メールアドレス') }}
                {{ Form::email('email', null, ['class' => 'form-control']) }}
            </div>
            <div>
                {{ Form::label('password', 'パスワード') }}
                {{ Form::password('password', ['class' => 'form-control']) }}
            </div>

            {{ Form::submit('ログイン', ['class' => 'd-block login-btn btn mx-auto mt-5 rounded-pill']) }}

            <p class="text-center">
                <a href="{{ route('signup.get') }}" id="register_account">アカウントを作成する</a>
            </p>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection