@extends('layouts.app')

@push('css')
    @auth
        <link rel="stylesheet" href="{{ asset('assets/css/welcomepage.css') }}">
    @endauth
    @guest
        <link rel="stylesheet" href="{{ asset('assets/css/welcomepage_guest.css') }}">
    @endguest
@endpush

@section('content')
    <main id="app">
        <div class="container text-center">
            <img src="{{ Url::URL_LIST['s3'] . Url::PICTURE_ACCESS_LIST['welcome_logo'] }}">
        </div>
        <how-to-section></how-to-section>
        <div class="jumbotron">
            <div class="container">
                <h2 class="main_visual_text">{{ Message::MAINPAGE_TEXT['main_title'] }}</h2>
            </div>
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
                        <div class="col-sm-9 mb-3 bg-white">
                            <h4 class="mt-3">{{ Message::MAINPAGE_TEXT['sub_title'] }}</h4>
                            <p>{!! nl2br(e(Message::MAINPAGE_TEXT['main_text'])) !!}</p>
                        </div>
                    </div>
                </div>
            </section>
            <section>
                <ul class="navbar-nav">
                    <div class="btn-bikeregister mx-auto d-block mb-4">
                        {{ link_to_route('bikes.index', Word::WORD_LIST['bikes_index'], [], ['class' => 'btn btn-primary']) }}
                        {{ link_to_route('search', Word::WORD_LIST['search'], [], ['class' => 'btn btn-info']) }}
                    </div>
                </ul>
            </section>
        @endguest
        @auth
        <section>
            <div class="container mt-4">
                <div class="row mb-4">
                    <div class="col mb-3 bg-white">
                        <h4 class="mt-3">{{ Message::MAINPAGE_TEXT['sub_title'] }}</h4>
                        <p>{!! nl2br(e(Message::MAINPAGE_TEXT['main_text'])) !!}</p>
                    </div>
                </div>
            </div>
        </section>
        @endauth
        {{-- 利用方法 --}}
        <section>
            <div class="container">
                <div class="row">
                    <div class="bg-warning py-4">
                        <section class="how_to">
                            <div class="row mb-4">
                                <div class="col-md-8 mb-3">
                                    <h3 class="headline font-weight-bold ml-2">ご利用方法</h3>
                                </div>
                            </div>
                            <div class="row mx-2">
                                {{-- カード1 --}}
                                <div class="col-md-4 mb-4">
                                    <div class="card" style="width: max-width: 20rem;">
                                        <div class="card-body">
                                            <h4 class="card-title">1.一覧から探す</h4>
                                        </div>
                                        <img class="card-img-bottom" src={{ URL::URL_LIST['s3'] . URL::PICTURE_ACCESS_LIST['how_to_picuture1'] }} alt="画像">
                                    </div>
                                </div>
                                {{-- カード2 --}}
                                <div class="col-md-4 mb-4">
                                    <div class="card" style="width: max-width: 20rem;">
                                        <div class="card-body">
                                            <h4 class="card-title">2.登録内容を確認</h4>
                                        </div>
                                        <img class="card-img-bottom" src={{ URL::URL_LIST['s3'] . URL::PICTURE_ACCESS_LIST['how_to_picuture2'] }} alt="画像">
                                    </div>
                                </div>
                                {{-- カード3 --}}
                                <div class="col-md-4 mb-4">
                                    <div class="card" style="width: max-width: 20rem;">
                                        <div class="card-body">
                                            <h4 class="card-title">3.予約確定</h4>
                                        </div>
                                        <img class="card-img-bottom" src={{ URL::URL_LIST['s3'] . URL::PICTURE_ACCESS_LIST['how_to_picuture3'] }} alt="画像">
                                    </div>
                                </div>
                                {{-- カード4 --}}
                                <div class="col-md-4 mb-4">
                                    <div class="card" style="width: max-width: 20rem;">
                                        <div class="card-body">
                                            <h4 class="card-title">4.自転車をレンタル</h4>
                                        </div>
                                        <img class="card-img-bottom" src={{ URL::URL_LIST['s3'] . URL::PICTURE_ACCESS_LIST['how_to_picuture4'] }} alt="画像">
                                    </div>
                                </div>
                                {{-- カード5 --}}
                                <div class="col-md-4 mb-4">
                                    <div class="card" style="width: max-width: 20rem;">
                                        <div class="card-body">
                                            <h4 class="card-title">5.自転車を返却</h4>
                                        </div>
                                        <img class="card-img-bottom" src={{ URL::URL_LIST['s3'] . URL::PICTURE_ACCESS_LIST['how_to_picuture3'] }} alt="画像">
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection