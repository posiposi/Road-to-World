@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/css/mypage.css') }}">
@endpush

@section('content')
<div class="container">
    <div class="row pageheader mt-3 mb-5 bg-light bg-gradient">
        <h2 class="text-left">{{ Word::PAGE_TITLE['mypage'] }}</h2>
        @if($login_user->image != null)
        <img class="avatar-img img-fluid rounded-circle" src="{{ $login_user->image }}" alt="{{ Word::MYPAGE_LABEL['alt_register_avatar'] }}">
        @else
        <img class="avatar-img img-fluid rounded-circle" src="{{ $avatar_noimage }}" alt="{{ Word::MYPAGE_LABEL['alt_default_avatar'] }}">
        @endif
    </div>

    <div class="row user-info">
        <table class="table">
            <tbody>
                <tr>
                    <th>{{ Word::MYPAGE_LABEL['user_name'] }}</th>
                    <td>{{ $login_user->name }}</td>
                </tr>
                <tr>
                    <th>{{ Word::MYPAGE_LABEL['user_nickname'] }}</th>
                    <td>{{ $login_user->nickname }}</td>
                </tr>
                <tr>
                    <th>{{ Word::MYPAGE_LABEL['user_mail'] }}</th>
                    <td>{{ $login_user->email }}</td>
                </tr>
                <tr>
                    <th>{{ Word::MYPAGE_LABEL['user_tel'] }}</th>
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
                    <p class="user-edit fw-bold">{{ Word::MYPAGE_LABEL['user_info'] }}</p>
                </a>
            </li>
            <li class="list-group-item col-md-6">
                <a href="#" class="reservation-calendar-link">
                    <i class="far fa-calendar-alt fa-2x"></i>
                    <p class="reservation-calendar fw-bold">{{ Word::MYPAGE_LABEL['reservation_calendar'] }}</p>
                </a>
            </li>
            <li class="list-group-item col-md-6">
                <a href="{{ route('mybike.index') }}" class="user-bike-index-link">
                    <i class="fas fa-bicycle fa-2x"></i>
                    <p class="fw-bold">{{ Word::MYPAGE_LABEL['mybike'] }}</p>
                </a>
            </li>
            <li class="list-group-item col-md-6">
                <a href="{{ route('logout.get') }}" class="user-bike-index-link">
                    <i class="fas fa-door-open fa-2x"></i>
                    <p class="fw-bold">{{ Word::MYPAGE_LABEL['logout'] }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>
@endsection