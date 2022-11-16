<head>
    <style>
        body { 
            padding-top: 60px; 
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
                <ul class="navbar-nav mr-auto">
                    <div class="btn-bikeregister">
                        {{ link_to_route('bikes.get', '自転車を貸す', [], ['class' => 'btn text-white']) }}
                        {{ link_to_route('bikes.index', '自転車を借りる', [], ['class' => 'btn text-white']) }}
                        {{ link_to_route('search', '自転車を検索', [], ['class' => 'btn text-white']) }}
                    </div>
                </ul>
                {{-- 右側メニュー --}}
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        {{-- ログインユーザーの場合はドロップダウンリストを表示する --}}
                        @if (Auth::check())
                            <a href="#" class="nav-link dropdown-toggle text-dark" data-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </a>
                        @endif
                        <ul class="dropdown-menu dropdown-menu-right">
                            {{-- ユーザ詳細ページへのリンク --}}
                            <li class="dropdown-item">{{ link_to_route('users.index', 'My Page', [], ['class' => 'nav-link text-primary']) }}</li>
                            <li class="dropdown-divider"></li>
                            {{-- ログアウトへのリンク --}}
                            <li class="dropdown-item">{{ link_to_route('logout.get', 'ログアウト') }}</li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>