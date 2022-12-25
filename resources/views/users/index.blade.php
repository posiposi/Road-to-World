@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/mypage.css') }}">
@endpush

@section('content')
<div class="container">
    <div class="row pageheader mt-3 mb-5 bg-light bg-gradient">
        <h2 class="text-left">マイページ</h2>
        @if($login_user->image != null)
        <img class="avatar-img" src="{{ $login_user->image }}" alt="登録アバター画像">
        @else
        <img class="avatar-img" src="{{ $avatar_noimage }}" alt="デフォルトアバター画像">
        @endif
    </div>

    <div class="row user-info">
        <table class="table">
            <tbody>
                <tr>
                    <th>氏名</th>
                    <td>{{ $login_user->name }}</td>
                </tr>
                <tr>
                    <th>ニックネーム</th>
                    <td>{{ $login_user->nickname }}</td>
                </tr>
                <tr>
                    <th>メールアドレス</th>
                    <td>{{ $login_user->email }}</td>
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td>{{ $login_user->tel }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="row">
        <ul class="row list-group list-group-horizontal user-contents-list">
            <li class="list-group-item col-md-6 my-auto">
                <a href="{{ route('users.edit') }}" class="user-info-link">
                    <i class="fas fa-user-edit fa-2x"></i>
                    <p class="user-edit fw-bold">会員情報</p>
                </a>
            </li>
            <li class="list-group-item col-md-6">
                <a href="#" class="reservation-calendar-link">
                    <i class="far fa-calendar-alt fa-2x"></i>
                    <p class="reservation-calendar fw-bold">予約表</p>
                </a>
            </li>
            <li class="list-group-item col-md-6">
                <a href="#" class="user-bike-index-link">
                    <i class="fas fa-bicycle fa-2x"></i>
                    <p class="fw-bold">マイバイク</p>
                </a>
            </li>
            <li class="list-group-item col-md-6">
                <a href="#" class="user-bike-index-link">
                    <i class="fas fa-door-open fa-2x"></i>
                    <p class="fw-bold">退会</p>
                </a>
            </li>
        </ul>
    </div>
</div>
@endsection