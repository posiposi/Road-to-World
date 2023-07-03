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
    <link rel="stylesheet" href="{{ asset('assets/css/layouts_app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">
    {{-- 個別CSS読み込み --}}
    @stack('css')
    @vite('resources/js/app.js')
</head>

<body>
    {{-- ナビゲーションバー --}}
    @include('commons.navbar')
    {{-- メインコンテンツ --}}
    @yield('content')
    {{-- フッター --}}
    @include('layouts.footer')
    {{-- エラーメッセージ --}}
    @include('commons.error_messages')

    <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    @yield('js')
</body>

</html>