{{-- 共通レイアウト --}}
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Road to World</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">
    {{-- 個別CSS読み込み --}}
    @stack('css')
</head>

<body style="height: 100%; margin: 0">
    <div class="wrapper" style="height: 100%; display: flex; flex-direction: column">
        {{-- ナビゲーションバー --}}
        @include('commons.navbar')

        {{-- フラッシュメッセージ --}}
        @if (session('flash_message'))
        <div class="flash_message bg-danger text-center py-3 my-0">
            {{ session('flash_message') }}
        </div>
        @endif

        {{-- 個別ページメインセクション --}}
        <main style="flex: auto">
            {{-- エラーメッセージ --}}
            @include('commons.error_messages')

            @yield('content')
        </main>
        {{-- フッター --}}
        @include('layouts.footer')
    </div>

    <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    <script src="{{ url(mix('js/app.js')) }}"></script>
    @yield('js')
</body>

</html>