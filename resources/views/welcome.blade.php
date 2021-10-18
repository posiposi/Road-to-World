@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <div class="py-4">
            <div class="container">
                <div id="main_visual" class="carousel slide carousel-fade" data-ride="carousel" data-wrap="true">
                    {{-- インジケーター --}}
                    {{--<ol class="carousel-indicators">
                        <li data-target="main_visual" data-slide-to="0" class="active"></li>
                        <li data-target="main_visual" data-slide-to="1"></li>
                        <li data-target="main_visual" data-slide-to="2"></li>
                    </ol>--}}
                    <div class="carousel-inner">
                        {{-- スライド01 --}}
                        {{--<div class="carousel-item active">
                            <img class="img-fluid" src="https://bikeshare-bucket001.s3.ap-northeast-1.amazonaws.com/4C258794-084E-4148-96C8-62784E38934C_1_105_c.jpeg" alt="写真">
                            <div class="carousel-caption d-none d-md-block">
                                {!! link_to_route('bikes.get', 'バイク登録', [], ['class' => 'btn btn-success']) !!}
                                {!! link_to_route('bikes.index', '貸出中バイク一覧', [], ['class' => 'btn btn-primary']) !!}
                                <h2 class="text-dark">ようこそ自転車の世界へ！</h2>
                                <p class="text-dark">一覧の中から気になった自転車をレンタル！世界へ漕ぎ出しましょう！</p>
                            </div>
                        </div>--}}
                        {{-- スライド02 --}}
                        <div class="carousel-item active">
                            <img class="img-fluid" src="https://bikeshare-bucket001.s3.ap-northeast-1.amazonaws.com/wallpaper2you_576757.jpg" alt="写真">
                            <div class="carousel-caption d-none d-md-block">
                                {!! link_to_route('bikes.get', 'バイク登録', [], ['class' => 'btn btn-success']) !!}
                                {!! link_to_route('bikes.index', '貸出中バイク一覧', [], ['class' => 'btn btn-primary']) !!}
                                <h2 class="text-dark">ようこそ自転車の世界へ！</h2>
                                <p class="text-dark">一覧の中から気になった自転車をレンタル！世界へ漕ぎ出しましょう！</p>
                            </div>
                        </div>
                        {{-- スライド03 --}}
                        <div class="carousel-item">
                            <img class="img-fluid" src="https://bikeshare-bucket001.s3.ap-northeast-1.amazonaws.com/gt_PC_W1920_H1080.png" alt="写真">
                            <div class="carousel-caption d-none d-md-block">
                                {!! link_to_route('bikes.get', 'バイク登録', [], ['class' => 'btn btn-success']) !!}
                                {!! link_to_route('bikes.index', '貸出中バイク一覧', [], ['class' => 'btn btn-primary']) !!}
                                <h2 class="text-dark">ようこそ自転車の世界へ！</h2>
                                <p class="text-dark">一覧の中から気になった自転車をレンタル！世界へ漕ぎ出しましょう！</p>
                            </div>
                        </div>
                    </div>
                    {{-- コントローラー --}}
                    {{--<a class="carousel-control-prev" href="main_visual" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">前に戻る</span>
                    </a>
                    <a class="carousel-control-next" href="main_visual" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">次に進む</span>
                    </a>--}}
                </div>
            </div>
        </div>
        <div class="py-4 bg-light">
            <section id="about">
                <div class="container">
                    <div class="row mb-4">
                        <div class="col-md-8 mb-3">
                            <h3 class="mb-3">Road to Worldについて</h3>
                            <p>このRoad to Worldは自転車レンタルを通じて世界へ走り出す人々の手助けをします。
                            購入・使用の敷居が高いロードバイクを借りることで新しい世界を見つけられるでしょう。
                            また、複数自転車を所有している人にはレンタル自転車を登録することで、
                            購入費用の回収とロードバイクの世界を多くの人に紹介する機会になります。
                            アプリ製作者の理念は上記を通じて日本の人々にロードバイクの世界を知ってもらうことにあります。</p>
                            <p>ロードバイクを借りて世界へ通じる'道'へ走り出しましょう！</p>
                            {!! link_to_route('bikes.get', 'バイク登録', [], ['class' => 'btn btn-success']) !!}
                            {!! link_to_route('bikes.index', '貸出中バイク一覧', [], ['class' => 'btn btn-primary']) !!}
                        </div>
                    
                        <div class="col-md-4">
                            <img src="https://bikeshare-bucket001.s3.ap-northeast-1.amazonaws.com/4C258794-084E-4148-96C8-62784E38934C_1_105_c.jpeg" alt="ロードバイク" class="img-fluid">
                        </div>
                    </div>
                </div>
            </section>
        </div>
    @else{{-- 未ログインの場合 --}}
        <div class="py-4">
            <div class="container">
                <div id="main_visual" class="carousel slide carousel-fade" data-ride="carousel" data-wrap="true">
                    {{-- インジケーター --}}
                    {{--<ol class="carousel-indicators">
                        <li data-target="main_visual" data-slide-to="0" class="active"></li>
                        <li data-target="main_visual" data-slide-to="1"></li>
                        <li data-target="main_visual" data-slide-to="2"></li>
                    </ol>--}}
                    <div class="carousel-inner">
                        {{-- スライド01 --}}
                        {{--<div class="carousel-item active">
                            <img class="img-fluid" src="https://bikeshare-bucket001.s3.ap-northeast-1.amazonaws.com/4C258794-084E-4148-96C8-62784E38934C_1_105_c.jpeg" alt="写真">
                            <div class="carousel-caption d-none d-md-block">
                                {!! link_to_route('signup.get', 'ユーザ登録', [], ['class' => 'btn btn-primary']) !!}
                                {!! link_to_route('login', 'ログイン', [], ['class' => 'btn btn-success']) !!}
                                <h2 class="text-dark">ようこそ自転車の世界へ！</h2>
                                <p class="text-dark">一覧の中から気になった自転車をレンタル！世界へ漕ぎ出しましょう！</p>
                            </div>
                        </div>--}}
                        {{-- スライド02 --}}
                        <div class="carousel-item active">
                            <img class="img-fluid" src="https://bikeshare-bucket001.s3.ap-northeast-1.amazonaws.com/wallpaper2you_576757.jpg" alt="写真">
                            <div class="carousel-caption d-none d-md-block">
                                {!! link_to_route('signup.get', 'ユーザ登録', [], ['class' => 'btn btn-primary']) !!}
                                {!! link_to_route('login', 'ログイン', [], ['class' => 'btn btn-success']) !!}
                                <h2 class="text-dark">ようこそ自転車の世界へ！</h2>
                                <p class="text-dark">一覧の中から気になった自転車をレンタル！世界へ漕ぎ出しましょう！</p>
                            </div>
                        </div>
                        {{-- スライド03 --}}
                        <div class="carousel-item">
                            <img class="img-fluid" src="https://bikeshare-bucket001.s3.ap-northeast-1.amazonaws.com/gt_PC_W1920_H1080.png" alt="写真">
                            <div class="carousel-caption d-none d-md-block">
                                {!! link_to_route('signup.get', 'ユーザ登録', [], ['class' => 'btn btn-primary']) !!}
                                {!! link_to_route('login', 'ログイン', [], ['class' => 'btn btn-success']) !!}
                                <h2 class="text-dark">ようこそ自転車の世界へ！</h2>
                                <p class="text-dark">一覧の中から気になった自転車をレンタル！世界へ漕ぎ出しましょう！</p>
                            </div>
                        </div>
                    </div>
                    {{-- コントローラー --}}
                    {{--<a class="carousel-control-prev" href="main_visual" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">前に戻る</span>
                    </a>
                    <a class="carousel-control-next" href="main_visual" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">次に進む</span>
                    </a>--}}
                </div>
            </div>
        </div>
        <div class="py-4 bg-light">
            <section id="about">
                <div class="container">
                    <div class="row mb-4">
                        <div class="col-md-8 mb-3">
                            <h3 class="mb-3">Road to Worldについて</h3>
                            <p>このRoad to Worldは自転車レンタルを通じて世界へ走り出す人々の手助けをします。
                            購入・使用の敷居が高いロードバイクを借りることで新しい世界を見つけられるでしょう。
                            また、複数自転車を所有している人にはレンタル自転車を登録することで、
                            購入費用の回収とロードバイクの世界を多くの人に紹介する機会になります。
                            アプリ製作者の理念は上記を通じて日本の人々にロードバイクの世界を知ってもらうことにあります。</p>
                            <p>ロードバイクを借りて世界へ通じる'道'へ走り出しましょう！</p>
                            {!! link_to_route('signup.get', 'ユーザ登録', [], ['class' => 'btn btn-primary']) !!}
                            {!! link_to_route('login', 'ログイン', [], ['class' => 'btn btn-success']) !!}
                        </div>
                    
                        <div class="col-md-4">
                            <img src="https://bikeshare-bucket001.s3.ap-northeast-1.amazonaws.com/4C258794-084E-4148-96C8-62784E38934C_1_105_c.jpeg" alt="ロードバイク" class="img-fluid">
                        </div>
                    </div>
                </div>
            </section>
        </div>        
    @endif
@endsection