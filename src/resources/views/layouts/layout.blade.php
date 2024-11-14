<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    @stack('styles')


    <link href="https://fonts.googleapis.com/css2?family=Carter+One&display=swap" rel="stylesheet">
    <style>
        .site-name {
            font-family: 'Carter One', sans-serif;
            font-size: 24px; 
            color: #FFD700;
            text-transform: none;
            letter-spacing: 1px;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-logo">
            <span class="site-name">mogitate</span>
        </div>
    </header>
    <main>
        @yield('content')
    </main>
</body>
</html>
