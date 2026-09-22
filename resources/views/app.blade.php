<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name') }} | Top Up Game & Voucher Digital</title>
        <meta name="description" content="WarGame - platform top up game dan voucher digital terpercaya di Indonesia. Top up Mobile Legends, Free Fire, PUBG Mobile, dan ratusan game lainnya secara instan, aman, dan harga terbaik.">
        <meta name="robots" content="index, follow">
        <link rel="canonical" href="{{ url()->current() }}">

        <meta property="og:site_name" content="{{ config('app.name') }}">
        <meta property="og:type" content="website">
        <meta property="og:title" content="{{ config('app.name') }} | Top Up Game & Voucher Digital">
        <meta property="og:description" content="Top up game dan voucher digital instan, aman, dan harga terbaik di Indonesia.">
        <meta property="og:image" content="{{ asset('logo.png') }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:locale" content="id_ID">

        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ config('app.name') }} | Top Up Game & Voucher Digital">
        <meta name="twitter:description" content="Top up game dan voucher digital instan, aman, dan harga terbaik di Indonesia.">
        <meta name="twitter:image" content="{{ asset('logo.png') }}">

        <link rel="icon" href="{{ asset('logo.png') }}">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

        <style>
            html, body {
                background-color: #111726;
            }

            #app-loading {
                position: fixed;
                inset: 0;
                z-index: 9999;
                display: flex;
                align-items: center;
                justify-content: center;
                background: #111726;
                transition: opacity 0.25s ease;
            }

            #app-loading.is-hidden {
                opacity: 0;
                pointer-events: none;
            }

            #app-loading .spinner {
                width: 44px;
                height: 44px;
                border-radius: 9999px;
                border: 3px solid rgba(255, 255, 255, 0.08);
                border-top-color: #f59e0b;
                border-right-color: #a855f7;
                animation: app-loading-spin 0.8s linear infinite;
            }

            @keyframes app-loading-spin {
                to { transform: rotate(360deg); }
            }
        </style>

        @viteReactRefresh
        @vite(['resources/js/app.jsx', 'resources/css/app.css'])
    </head>
    <body>
        <div id="app-loading">
            <div class="spinner"></div>
        </div>

        @inertia

        <script>
            (function () {
                var loader = document.getElementById('app-loading');
                var app = document.getElementById('app');
                if (!loader || !app) return;

                var hide = function () {
                    loader.classList.add('is-hidden');
                    setTimeout(function () { loader.remove(); }, 300);
                };

                if (app.childElementCount > 0) {
                    hide();
                    return;
                }

                var observer = new MutationObserver(function () {
                    if (app.childElementCount > 0) {
                        observer.disconnect();
                        hide();
                    }
                });
                observer.observe(app, { childList: true });
            })();
        </script>
    </body>
</html>
