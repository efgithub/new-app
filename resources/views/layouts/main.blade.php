<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>我的網站 - @yield('title')</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>

    <header style="background: #f4f4f4; padding: 20px;">
        <h1>我的品牌 LOGO</h1>
        <nav>
            <a href="/">首頁</a> | <a href="/about">關於我們</a>
        </nav>
    </header>

    <main style="padding: 40px;">
        @yield('content')
    </main>

    <footer style="background: #333; color: #fff; padding: 20px;">
        <p>&copy; 2024 Laravel 學習筆記</p>
    </footer>

</body>
</html>