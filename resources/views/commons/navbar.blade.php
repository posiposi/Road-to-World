<head>
    <style>
        body { 
            padding-top: 60px; 
        }
    </style>    
</head>

<header>
    <nav class="navbar navbar-expand-md navbar-dark bg-warning fixed-top">
        <div class="container">
            {{-- ブランド --}}
            <a class="navbar-brand" href="/"><img src ="https://bikeshare-bucket001.s3.ap-northeast-1.amazonaws.com/welcome/nav_logo2.png" alt="ロゴ"></a>
            {{-- 切り替えボタン --}}
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-bar">
                <span class="navbar-toggler-icon"></span>
            </button>
            {{-- ナビゲーション --}}
            <div class="collapse navbar-collapse" id="nav-bar">
                {{-- ログイン中の場合 --}}
                @if(Auth::check())
                    {{-- 左側メニュー --}}
                    <ul class="navbar-nav mr-auto">
                        <div class="btn-bikeregister">
                            {!! link_to_route('bikes.get', '自転車を貸す', [], ['class' => 'btn btn-success']) !!}
                            {!! link_to_route('bikes.index', '自転車を借りる', [], ['class' => 'btn btn-primary']) !!}
                            {!! link_to_route('search', '自転車を検索', [], ['class' => 'btn btn-info']) !!}
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