<head>
    <link rel="stylesheet" href="{{ asset('assets/css/navbar.css') }}">
</head>

<header>
    <nav class="navbar navbar-expand-sm navbar-dark fixed-top" style="background-color: olivedrab">
        <div class="container">
            {{-- ブランド --}}
            <a class="navbar-brand" href="/">Home</a>
            {{-- 切り替えボタン --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
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
                    {{-- ユーザーログイン時 --}}
                    @auth
                    <a href="{{ route('users.index') }}">
                        <i class="fas fa-user-circle fa-2x user-circle-icon"></i>
                    </a>
                    @endauth
                    {{-- ゲストユーザーログイン時 --}}
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