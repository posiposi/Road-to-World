@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <div class="py-4">
            <div class="container-fluid">
                <div class="row">
                    <div id="main_visual" class="col-sm-12 carousel slide carousel-fade" data-ride="carousel" data-wrap="true">
                        <div class="carousel-inner">
                            {{-- スライド01 --}}
                            <div class="carousel-item active">
                                <img class="img-fluid" src="https://bikeshare-bucket001.s3.ap-northeast-1.amazonaws.com/22226569.jpg" alt="写真">
                            </div>
                            {{-- スライド02 --}}
                            <div class="carousel-item">
                                <img class="img-fluid" src="https://bikeshare-bucket001.s3.ap-northeast-1.amazonaws.com/1411880.jpg" alt="写真">
                            </div>
                            {{-- スライド03 --}}
                            <div class="carousel-item">
                                <img class="img-fluid" src="https://bikeshare-bucket001.s3.ap-northeast-1.amazonaws.com/2017043.jpg" alt="写真">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-4">
            <section id="about">
                <div class="container-fluid bg-light">
                    <div class="row mb-4">
                        <div class="col-md-12 mb-3">
                            <h3 class="mb-3">ようこそ自転車の世界へ！</h3>
                            <h4>一覧の中から気になった自転車をレンタル！世界へ漕ぎ出しましょう！</h4>
                            <p>このRoad to Worldは自転車レンタルを通じて世界へ走り出す人々の手助けをします。
                            購入・使用の敷居が高いロードバイクを借りることで新しい世界を見つけられるでしょう。
                            また、複数自転車を所有している人にはレンタル自転車を登録することで、
                            購入費用の回収とロードバイクの世界を多くの人に紹介する機会になります。
                            アプリ製作者の理念は上記を通じて日本の人々にロードバイクの世界を知ってもらうことにあります。</p>
                            <p>ロードバイクを借りて世界へ通じる'道'へ走り出しましょう！</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    @else{{-- 未ログインの場合 --}}
        <div class="py-4">
            <div class="container-fluid">
                <div class="row">
                    <div id="main_visual" class="col-sm-12 carousel slide carousel-fade" data-ride="carousel" data-wrap="true">
                        <div class="carousel-inner">
                            {{-- スライド01 --}}
                            <div class="carousel-item active">
                                <img class="img-fluid" src="https://bikeshare-bucket001.s3.ap-northeast-1.amazonaws.com/22226569.jpg" alt="写真">
                            </div>
                            {{-- スライド02 --}}
                            <div class="carousel-item">
                                <img class="img-fluid" src="https://bikeshare-bucket001.s3.ap-northeast-1.amazonaws.com/1411880.jpg" alt="写真">
                            </div>
                            </div>
                            {{-- スライド03 --}}
                            <div class="carousel-item">
                                <img class="img-fluid" src="https://bikeshare-bucket001.s3.ap-northeast-1.amazonaws.com/2017043.jpg" alt="写真">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-4">
            <section id="about">
                <div class="container-fluid bg-light">
                    <div class="row mb-4">
                        <div class="col-md-12 mb-3">
                            <h3 class="mb-3">ようこそ自転車の世界へ！</h3>
                            <h4>一覧の中から気になった自転車をレンタル！世界へ漕ぎ出しましょう！</h4>
                            <p>このRoad to Worldは自転車レンタルを通じて世界へ走り出す人々の手助けをします。<br>
                            購入・使用の敷居が高いロードバイクを借りることで新しい世界を見つけられるでしょう。<br>
                            また、複数自転車を所有している人にはレンタル自転車を登録することで、
                            購入費用の回収とロードバイクの世界を多くの人に紹介する機会になります。<br>
                            アプリ製作者の理念は上記を通じて日本の人々にロードバイクの世界を知ってもらうことにあります。</p>
                            <p>ロードバイクを借りて世界へ通じる'道'へ走り出しましょう！</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>        
    @endif
@endsection