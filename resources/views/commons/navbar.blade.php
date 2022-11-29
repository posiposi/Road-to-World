<head>
    <style>
        body { 
            padding-top: 60px; 
        }
        .user-circle-icon {
            color: black;
        }
    </style>
</head>

<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top" style="background-color: olivedrab">
        <div class="container">
            {{-- ブランド --}}
            <a class="navbar-brand" href="/">Home</a>
            {{-- 切り替えボタン --}}
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-bar">
                <span class="navbar-toggler-icon"></span>
            </button>
            {{-- ナビゲーション --}}
            <div class="collapse navbar-collapse" id="nav-bar">
                {{-- 左側メニュー --}}
                <ul class="navbar-nav me-auto">
                    <div class="btn-bikeregister">
                        {{ link_to_route('bikes.get', '自転車を貸す', [], ['class' => 'btn text-white']) }}
                        {{ link_to_route('bikes.index', '自転車を借りる', [], ['class' => 'btn text-white']) }}
                        {{ link_to_route('search', '自転車を検索', [], ['class' => 'btn text-white']) }}
                    </div>
                </ul>
                {{-- 右側メニュー --}}
                <ul class="navbar-nav ms-auto">
                    @auth
                    <li class="nav-item dropdown">
                        {{-- ログインユーザーの場合はドロップダウンリストを表示する --}}
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDarkDropdownMenuLink">
                            {{-- ユーザ詳細ページへのリンク --}}
                            <li>{{ link_to_route('users.index', 'My Page', [], ['class' => 'nav-link text-primary dropdown-item']) }}</li>
                            <li class="dropdown-divider"></li>
                            {{-- ログアウトへのリンク --}}
                            <li><a href="{{ route('logout.get') }}">ログアウト</a></li>
                        </ul>
                    </li>
                    @endauth
                    {{-- ゲストユーザー用ログインページリンク --}}
                    @guest
                        <a href="{{ route('login') }}">
                            <i class="fas fa-user-circle fa-2x user-circle-icon"></i>
                        </a>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>