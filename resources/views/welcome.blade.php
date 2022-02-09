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
    <main>
        <div class="container text-center">
            <img src ="https://bikeshare-bucket001.s3.ap-northeast-1.amazonaws.com/welcome/logomark.png" alt="ロゴ">
        </div>
        <div class="jumbotron">
            <div class="container">
                <h2 class="main_visual_text">ようこそロードバイクの世界へ</h2>
            </div>
        </div>
        @guest
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-3">
                            {!! Form::open(['route' => 'login.post']) !!}
                                <div class="form-group">
                                    {!! Form::label('email', 'メールアドレス') !!}
                                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('password', 'パスワード') !!}
                                    {!! Form::password('password', ['class' => 'form-control']) !!}
                                </div>
                                {!! Form::submit('ログイン', ['class' => 'btn btn-primary btn-block']) !!}
                            {!! Form::close() !!}
                            <div class="text-right">
                                {!! link_to_route('signup.get', '初めての方はこちら', [], ['class' => 'btn btn-signup']) !!}
                            </div>
                        </div>
                        <div class="col-sm-9 mb-3 bg-white">
                            <h4 class="mt-3">一覧の中から気になった自転車をレンタル！世界へ漕ぎ出しましょう！</h4>
                            <p>Road to Worldは自転車レンタルを通じて世界へ走り出す人々の手助けをします。<br>
                            購入・使用の敷居が高いロードバイクを借りることで新しい世界を見つけられるでしょう。<br>
                            また、複数自転車を所有している人にはレンタル自転車を登録することで、
                            購入費用の回収とロードバイクの世界を多くの人に紹介する機会になります。<br>
                            アプリ製作者の理念は上記を通じて日本の人々にロードバイクの世界を知ってもらうことにあります。</p>
                            <p>ロードバイクを借りて世界へ通じる'道'へ走り出しましょう！</p>
                        </div>
                    </div>
                </div>
            </section>
        @endguest
        @auth
        <section>
            <div class="container mt-4">
                <div class="row mb-4">
                    <div class="col mb-3 bg-white">
                        <h4 class="mt-3">一覧の中から気になった自転車をレンタル！世界へ漕ぎ出しましょう！</h4>
                        <p>Road to Worldは自転車レンタルを通じて世界へ走り出す人々の手助けをします。<br>
                        購入・使用の敷居が高いロードバイクを借りることで新しい世界を見つけられるでしょう。<br>
                        また、複数自転車を所有している人にはレンタル自転車を登録することで、
                        購入費用の回収とロードバイクの世界を多くの人に紹介する機会になります。<br>
                        アプリ製作者の理念は上記を通じて日本の人々にロードバイクの世界を知ってもらうことにあります。</p>
                        <p>ロードバイクを借りて世界へ通じる'道'へ走り出しましょう！</p>
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
                                        <img class="card-img-bottom" src="https://bikeshare-bucket001.s3.ap-northeast-1.amazonaws.com/welcome/how_to_1.jpg" alt="画像">
                                    </div>
                                </div>
                                {{-- カード2 --}}
                                <div class="col-md-4 mb-4">
                                    <div class="card" style="width: max-width: 20rem;">
                                        <div class="card-body">
                                            <h4 class="card-title">2.登録内容を確認</h4>
                                        </div>
                                        <img class="card-img-bottom" src="https://bikeshare-bucket001.s3.ap-northeast-1.amazonaws.com/welcome/how_to_2.jpg" alt="画像">
                                    </div>
                                </div>
                                {{-- カード3 --}}
                                <div class="col-md-4 mb-4">
                                    <div class="card" style="width: max-width: 20rem;">
                                        <div class="card-body">
                                            <h4 class="card-title">3.予約確定</h4>
                                        </div>
                                        <img class="card-img-bottom" src="https://bikeshare-bucket001.s3.ap-northeast-1.amazonaws.com/welcome/how_to_3.jpg" alt="画像">
                                    </div>
                                </div>
                                {{-- カード4 --}}
                                <div class="col-md-4 mb-4">
                                    <div class="card" style="width: max-width: 20rem;">
                                        <div class="card-body">
                                            <h4 class="card-title">4.自転車をレンタル</h4>
                                        </div>
                                        <img class="card-img-bottom" src="https://bikeshare-bucket001.s3.ap-northeast-1.amazonaws.com/welcome/how_to_4.jpg" alt="画像">
                                    </div>
                                </div>
                                {{-- カード5 --}}
                                <div class="col-md-4 mb-4">
                                    <div class="card" style="width: max-width: 20rem;">
                                        <div class="card-body">
                                            <h4 class="card-title">5.自転車を返却</h4>
                                        </div>
                                        <img class="card-img-bottom" src="https://bikeshare-bucket001.s3.ap-northeast-1.amazonaws.com/welcome/how_to_5.jpg" alt="画像">
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