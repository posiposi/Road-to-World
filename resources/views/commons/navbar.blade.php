<header class="mb-4">
    <nav class="navbar navbar-expand-sm navbar-dark bg-warning">
        {{-- トップページへのリンク --}}
        <a class="navbar-brand" href="/">Road to World</a>

        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                {{-- ログイン中の場合 --}}
                @if(Auth::check())
                    <div class="row">
                        <div class="btn-bikeregister">
                            {!! link_to_route('bikes.get', 'バイク登録', [], ['class' => 'btn btn-success']) !!}
                        </div>
                        <div class="btn-bikesindex mx-2">
                            {!! link_to_route('bikes.index', '貸出中バイク一覧', [], ['class' => 'btn btn-primary']) !!}
                        </div>
                    
                        {{-- ユーザ一覧ページへのリンク --}}
                        {{--<li class="nav-item"><a href="#" class="nav-link">Users</a></li>--}}
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}</a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                {{-- ユーザ詳細ページへのリンク --}}
                                <li class="dropdown-item">{!! link_to_route('users.index', 'My Page', [], ['class' => 'nav-link text-primary']) !!}</li>
                                <li class="dropdown-divider"></li>
                                {{-- ログアウトへのリンク --}}
                                <li class="dropdown-item">{!! link_to_route('logout.get', 'ログアウト') !!}</li>
                            </ul>
                        </li>
                    </div>
                {{-- 未ログインの場合 --}}
                @else
                    <div class="row">
                        {{-- ユーザ登録ページへのリンク --}}
                        <div class="btn-signup">{!! link_to_route('signup.get', 'ユーザ登録', [], ['class' => 'btn btn-success']) !!}</div>
                        {{-- ログインページへのリンク --}}
                        <div class="btn-login mx-2">{!! link_to_route('login', 'ログイン', [], ['class' => 'btn btn-primary']) !!}</div>
                    </div>
                @endif
            </ul>
        </div>
    </nav>
</header>