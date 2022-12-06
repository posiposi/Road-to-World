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
    <nav class="navbar navbar-expand-sm navbar-dark fixed-top" style="background-color: olivedrab">
        <div class="container">
            {{-- ブランド --}}
            <a class="navbar-brand" href="/">Home</a>
            {{-- 切り替えボタン --}}
            <button class="navbar-toggler" type="button"  data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            {{-- ナビゲーション --}}
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                {{-- 左側メニュー --}}
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        {{ link_to_route('bikes.get', '自転車を貸す', [], ['class' => 'btn text-white']) }}
                    </li>
                    <li class="nav-item">
                        {{ link_to_route('bikes.index', '自転車を借りる', [], ['class' => 'btn text-white']) }}
                    </li>
                    <li class="nav-item">
                        {{ link_to_route('search', '自転車を検索', [], ['class' => 'btn text-white']) }}
                    </li>
                </ul>
                {{-- 右側メニュー --}}
                <ul class="navbar-nav ms-auto">
                    @auth
                    <li class="nav-item dropdown">
                        {{-- ログインユーザーの場合はドロップダウンリストを表示する --}}
                        <a class="dropdown-toggle link-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDarkDropdownMenuLink">
                            {{-- ユーザ詳細ページへのリンク --}}
                            <li>{{ link_to_route('users.index', 'My Page', [], ['class' => 'nav-link text-dark dropdown-item']) }}</li>
                            <li class="dropdown-divider"></li>
                            {{-- ログアウトへのリンク --}}
                            <li><a href="{{ route('logout.get') }}" class="nav-link text-dark dropdown-item">ログアウト</a></li>
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