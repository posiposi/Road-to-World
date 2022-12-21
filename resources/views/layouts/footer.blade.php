{{-- 定数を使用するためにサービスクラスを注入 --}}
@inject('messages', 'App\Services\MessageService')

<footer class="bg-secondary text-white text-center text-md-start">
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
                <h5 class="text-uppercase">{{ $messages->getFooterContentsTitle() }}</h5>
                <p>
                    {{ $messages->getFooterContentsText() }}
                </p>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase">Links</h5>
                <ul class="list-unstyled">
                    <li>
                        <a href="#!" class="text-white">Link 1</a>
                    </li>
                    <li>
                        <a href="#!" class="text-white">Link 2</a>
                    </li>
                    <li>
                        <a href="#!" class="text-white">Link 3</a>
                    </li>
                    <li>
                        <a href="#!" class="text-white">Link 4</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase">Links</h5>
                <ul class="list-unstyled">
                    <li>
                        <a href="#!" class="text-white">Link 1</a>
                    </li>
                    <li>
                        <a href="#!" class="text-white">Link 2</a>
                    </li>
                    <li>
                        <a href="#!" class="text-white">Link 3</a>
                    </li>
                    <li>
                        <a href="#!" class="text-white">Link 4</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="sns-link">
            <a class="btn text-white btn-floating m-1 github-link-icon" href="https://github.com/posiposi/Road-to-World">
                <i class="fab fa-github"></i>
            </a>
        </div>
    </div>
    <div class="text-center p-3 copyright-text">
        © 2022 Copyright: Daichi Sugiyama
    </div>
</footer>