@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/welcomepage.css') }}">
@endpush

@section('content')
    <main id="app">
        <div>
            <main-page-visual welcome_logo_path="{{ $welcome_logo_path }}"></main-page-visual>
        </div>
        @guest
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-3">
                            {{ Form::open(['route' => 'login.post']) }}
                                <div class="form-group">
                                    {{ Form::label('email', Word::WORD_LIST['email']) }}
                                    {{ Form::email('email', null, ['class' => 'form-control']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('password', Word::WORD_LIST['password']) }}
                                    {{ Form::password('password', ['class' => 'form-control']) }}
                                </div>
                                {{ Form::submit(Word::WORD_LIST['login'], ['class' => 'btn btn-primary btn-block']) }}
                            {{ Form::close() }}
                            <div class="text-right mt-2">
                                {{ link_to_route('signup.get', Word::WORD_LIST['signup'], [], ['class' => 'text-dark']) }}
                            </div>
                        </div>
                        {{-- サイト説明文章 --}}
                        <div class="col-sm-9 mb-3 bg-white">
                            <h4 class="mt-3">{{ Message::MAINPAGE_TEXT['sub_title'] }}</h4>
                            <p>{!! nl2br(e(Message::MAINPAGE_TEXT['main_text'])) !!}</p>
                        </div>
                    </div>
                </div>
            </section>
            {{-- 画像下部リンクボタンセクション --}}
            <section>
                <ul class="navbar-nav">
                    <div class="btn-bikeregister mx-auto d-block mb-4">
                        {{-- 自転車一覧リンクボタン --}}
                        {{ link_to_route('bikes.index', Word::WORD_LIST['bikes_index'], [], ['class' => 'btn btn-primary']) }}
                        {{-- 自転車検索画面リンクボタン --}}
                        {{ link_to_route('search', Word::WORD_LIST['search'], [], ['class' => 'btn btn-info']) }}
                    </div>
                </ul>
            </section>
        @endguest
        @auth
        <section>
            <div class="container mt-4">
                <div class="row mb-4">
                    {{-- サイト説明文章 --}}
                    <div class="col mb-3 bg-white">
                        <h4 class="mt-3">{{ Message::MAINPAGE_TEXT['sub_title'] }}</h4>
                        <p>{!! nl2br(e(Message::MAINPAGE_TEXT['main_text'])) !!}</p>
                    </div>
                </div>
            </div>
        </section>
        @endauth
    </main>
@endsection