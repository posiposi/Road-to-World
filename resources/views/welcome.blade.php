@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/welcomepage.css') }}">
@endpush

@section('content')
    <header>
        <div class="container text-center">
            <img src ="https://bikeshare-bucket001.s3.ap-northeast-1.amazonaws.com/welcome/logomark.png" alt="ロゴ">
            <h3>ようこそ自転車の世界へ！</h3>
        </div>
    </header>
    <div class="container-fluid">
        <div class="row">
            <div id="main_visual" class="col carousel slide" data-ride="carousel" data-wrap="true">
                <div class="carousel-inner">
                    {{-- スライド01 --}}
                    <div class="carousel-item active">
                        <img class="img-fluid" src="https://bikeshare-bucket001.s3.ap-northeast-1.amazonaws.com/1411880.jpg" alt="写真">
                    </div>
                    {{-- スライド02 
                    <div class="carousel-item">
                        <img class="img-fluid" src="/images/Carousel5.jpg" alt="写真">
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="left-side col-sm-3 mt-3 bg-primary">
                <div class="search-title">
                    <h4 class="font-weight-bold mt-2">検索フォーム</h4>
                </div>
                <div class="search-body">
                    <ul class="search-body-list">
                        <li class="search-body-list-item">
                            <p>モデル名で自転車を探す</p>
                        </li>
                        <li>
                            <p>ブランド名で自転車を探す</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-9 mb-3 bg-white">
                <h4 class="mt-3">一覧の中から気になった自転車をレンタル！世界へ漕ぎ出しましょう！</h4>
                <p>このRoad to Worldは自転車レンタルを通じて世界へ走り出す人々の手助けをします。<br>
                購入・使用の敷居が高いロードバイクを借りることで新しい世界を見つけられるでしょう。<br>
                また、複数自転車を所有している人にはレンタル自転車を登録することで、
                購入費用の回収とロードバイクの世界を多くの人に紹介する機会になります。<br>
                アプリ製作者の理念は上記を通じて日本の人々にロードバイクの世界を知ってもらうことにあります。</p>
                <p>ロードバイクを借りて世界へ通じる'道'へ走り出しましょう！</p>
            </div>
        </div>
        {{-- 利用方法 --}}
        <div class="py-4 bg-warning">
            <section class="how_to">
                <div class="container">
                    <div class="row mb-4">
                        <div class="col-md-8 mb-3">
                            <h3 class="mb-3 headline">ご利用方法</h3>
                        </div>
                    </div>
                    <div class="row">
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
                </div>
            </section>
        </div>
    </div>
@endsection