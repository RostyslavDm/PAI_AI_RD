<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $page_description ?? 'Opis domyślny' }}">
    <title>{{ $page_title ?? 'Tytuł domyślny' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/templatemo-605-xmas-countdown.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <header>
        <a href="#" class="logo">
            {!! $page_header ?? 'Tytuł domyślny' !!}
        </a>
    </header>

    <main>
        <div class="glass-strong calc-wrapper">
            @yield('content', 'Domyślna treść zawartości ....')
        </div>
    </main>

    <footer style="padding: 20px 40px; border-top: 1px solid var(--border-glass); text-align:center;">
        <p>
            @yield('footer', 'Domyślna treść stopki ....')
        </p>
        <p style="font-size:0.85rem; color:var(--text-dim);">
            Widok oparty na stylach i szablonie
            <a href="https://templatemo.com/tm-605-xmas-countdown" target="_blank">Templatemo</a>
        </p>
    </footer>

</body>
</html>