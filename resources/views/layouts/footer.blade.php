{{-- 定数を使用するためにサービスクラスを注入 --}}
@inject('messages', 'App\Services\MessageService')

<footer class="bg-secondary text-white text-center text-md-start mt-5 text_font">
    <div class="container p-4 pb-2">
        @guest
        <div class="row mb-3">
            <p class="d-flex justify-content-center align-items-center">
                <span class="me-3">会員登録はこちらから</span>
                <button type="button" class="btn btn-rounded">
                    <a href="{{ route('signup.get') }}" class="text-white">Sign up!</a>
                </button>
            </p>
        </div>
        @endguest
        <div class="row mb-2">
            <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                <h5 class="footer-title">{{ $messages->getFooterContentsTitle() }}</h5>
                <p class="footer-text">
                    {{ $messages->getFooterContentsText() }}
                </p>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase">サポート</h5>
                <ul class="list-unstyled">
                    <li>
                        <a href="{{ route('home') }}" class="text-white">Home</a>
                    </li>
                    <li class="mt-2">
                        <a href="#!" class="text-white">利用方法</a>
                    </li>
                    <li class="mt-2">
                        <a href="#!" class="text-white">お問合せ</a>
                    </li>
                    <li class="mt-2">
                        <a href="#!" class="text-white">利用規約</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase">会員ページ</h5>
                <ul class="list-unstyled">
                    <li>
                        <a href="{{ route('users.index') }}" class="text-white">マイページ</a>
                    </li>
                    <li class="mt-2">
                        <a href="#!" class="text-white">予約表</a>
                    </li>
                    <li class="mt-2">
                        <a href="{{ route('mybike.index') }}" class="text-white">マイバイク</a>
                    </li>
                    @auth
                    <li class="mt-2">
                        <a href="{{ route('logout.get') }}" class="text-white">ログアウト</a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
        <div class="sns-link">
            <a class="btn text-white btn-floating m-1 github-link-icon"
                href={{ Url::LINK_URL['github'] }}>
                <i class="fab fa-github"></i>
            </a>
        </div>
    </div>
    <div class="text-center p-3 copyright-text">
        © 2022 Copyright: Daichi Sugiyama
    </div>
</footer>