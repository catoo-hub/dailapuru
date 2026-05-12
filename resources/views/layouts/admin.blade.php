<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Админка — Дай Лапу')</title>
    <meta name="description" content="@yield('meta_description', 'Административная панель зоомагазина Дай Лапу.')">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100 text-slate-950 antialiased">
    <div class="grid min-h-screen lg:grid-cols-[280px_1fr]">
        @include('admin.components.sidebar')

        <div class="min-w-0">
            <header class="sticky top-0 z-20 border-b border-slate-200 bg-white/95 px-5 py-4 backdrop-blur lg:px-8">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div>
                        <p class="text-xs font-extrabold uppercase tracking-[0.16em] text-brand-blue">Администрирование</p>
                        <h1 class="text-2xl font-extrabold">@yield('page_title', 'Панель управления')</h1>
                    </div>

                    <div class="flex items-center gap-3">
                        <a href="{{ route('home') }}" class="inline-flex h-10 items-center rounded-lg border border-slate-200 px-4 text-sm font-bold transition hover:bg-slate-50">
                            На сайт
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="inline-flex h-10 items-center rounded-lg bg-slate-950 px-4 text-sm font-extrabold text-white transition hover:bg-slate-800">
                                Выйти
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <main class="px-5 py-6 lg:px-8">
                @if (session('status'))
                    <div class="mb-5 rounded-lg border border-emerald-200 bg-emerald-50 p-4 text-sm font-bold text-emerald-700">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-5 rounded-lg border border-red-200 bg-red-50 p-4 text-sm font-bold text-red-700">
                        {{ $errors->first() }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
