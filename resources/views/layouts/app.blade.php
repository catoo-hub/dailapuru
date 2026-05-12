<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Дай Лапу — зоомагазин')</title>
    <meta name="description" content="@yield('meta_description', 'Корма, аксессуары и средства ухода для животных в зоомагазине «Дай Лапу».')">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800&family=Climate+Crisis&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
@php
    $callPhone = ($siteSettings ?? collect())->get('call_phone', '+79000000000');
@endphp
<body class="min-h-screen bg-brand-blue-dark text-brand-black antialiased">
    <div class="mx-auto w-full max-w-[1620px] px-6">
        <x-header :active="$active ?? 'catalog'" />

        @yield('content')
    </div>

    <a href="tel:{{ $callPhone }}"
       class="fixed bottom-5 right-5 z-50 inline-flex h-14 items-center gap-2 rounded-chip bg-brand-pink px-2.5 text-base font-extrabold text-white shadow-lg transition hover:bg-brand-pink/50 focus:outline-none focus:ring-4 focus:ring-white/50">
        <span class="grid h-9 w-9 place-items-center rounded-full bg-white/20">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                 fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.79 19.79 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
            </svg>
        </span>
    </a>
</body>
</html>
