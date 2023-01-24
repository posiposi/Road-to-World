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
                    {{ Form::label('name', '氏名') }}
                    {{ Form::text('name', null, ['class' => 'form-control']) }}
                </div>

                <div class="mt-3">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ Form::label('nickname', 'ニックネーム') }}
                    {{ Form::text('nickname', null, ['class' => 'form-control']) }}
                </div>

                <div class="mt-3">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ Form::label('email', 'メールアドレス') }}
                    {{ Form::email('email', null, ['class' => 'form-control']) }}
                </div>

                <div class="mt-3">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ Form::label('tel', '電話番号') }}
                    {{ Form::text('tel', null, ['class' => 'form-control', 'placeholder' => 'ハイフン無しの半角数字で入力して下さい。'])}}
                </div>

                <div class="mt-3">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ Form::label('password', 'パスワード') }}
                    {{ Form::password('password', ['class' => 'form-control', 'placeholder' => '8文字以上で入力して下さい。']) }}
                </div>

                <div class="mt-3">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ Form::label('password_confirmation', 'パスワード確認') }}
                    {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
                </div>

                {{ Form::submit('登録', ['class' => 'btn user-register-btn rounded-pill mt-3']) }}
            </form>
        </div>
    </div>
</div>
@endsection