<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Tasklist</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://cdn.jsdelivr.net/npm/daisyui@2.24.0/dist/full.css" rel="stylesheet" type="text/css" />
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
        
    <body>
        {{-- ナビゲーションバー navbar.blade.phpを読み込んで利用 --}}
        @include('commons.navbar')
        
        <div class="container mx-auto">
            {{-- エラーメッセージ error_messages.blade.phpを読み込んで利用 --}}
            @include('commons.error_messages')
            
            {{-- 継承先@section('content')を利用 --}}
            @yield('content')
        </div>
    </body>
</html>