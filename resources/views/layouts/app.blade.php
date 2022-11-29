{{-- 共通レイアウト --}}

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Road to World</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        {{-- 個別CSS読み込み --}}
        @stack('css')
    </head>

    <body>
        <div class="wrapper">
            {{-- ナビゲーションバー --}}
            @include('commons.navbar')

            {{-- フラッシュメッセージ --}}
            @if (session('flash_message'))
                <div class="flash_message bg-danger text-center py-3 my-0">
                    {{ session('flash_message') }}
                </div>
            @endif

            <div id=" wrapper">
                {{-- エラーメッセージ --}}
                @include('commons.error_messages')

                @yield('content')
            </div>
        </div>

        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
        <script src="{{ url(mix('js/app.js')) }}"></script>
        @yield('js')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>