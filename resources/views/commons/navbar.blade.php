<header>
    <nav class="navbar navbar-expand-md navbar-dark bg-warning sticky-top">
        <div class="container">
            {{-- ブランド --}}
            <a class="navbar-brand" href="/">Road to World</a>
            {{-- 切り替えボタン --}}
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-bar">
                <span class="navbar-toggler-icon"></span>
            </button>
            {{-- ナビゲーション --}}
            <div class="collapse navbar-collapse" id="nav-bar">
                {{-- ナビゲーションメニュー --}}
                {{-- ログイン中の場合 --}}
                @if(Auth::check())
                    {{-- 左側メニュー --}}
                    <ul class="navbar-nav mr-auto">
                        <div class="btn-bikeregister">
                            {!! link_to_route('bikes.get', 'バイク登録', [], ['class' => 'btn btn-success']) !!}
                            {!! link_to_route('bikes.index', '貸出中バイク一覧', [], ['class' => 'btn btn-primary']) !!}
                        </div>
                    </ul>
                    {{-- 右側メニュー --}}
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle text-dark" data-toggle="dropdown">
                            {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                {{-- ユーザ詳細ページへのリンク --}}
                                <li class="dropdown-item">{!! link_to_route('users.index', 'My Page', [], ['class' => 'nav-link text-primary']) !!}</li>
                                <li class="dropdown-divider"></li>
                                {{-- ログアウトへのリンク --}}
                                <li class="dropdown-item">{!! link_to_route('logout.get', 'ログアウト') !!}</li>
                            </ul>
                        </li>
                    </ul>
                
                {{-- 未ログインの場合 --}}
                @else
                    <ul class="navbar-nav mr-auto">
                            <div class="btn-signup">
                                {!! link_to_route('signup.get', 'ユーザ登録', [], ['class' => 'btn btn-success']) !!}
                                {!! link_to_route('login', 'ログイン', [], ['class' => 'btn btn-primary']) !!}
                            </div>
                    </ul>
                @endif
            </div>
        </div>
    </nav>
</header>