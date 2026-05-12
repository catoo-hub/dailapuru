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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Bowlby+One&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-brand-blue text-brand-black antialiased">
    <div class="mx-auto w-full max-w-[1620px] px-6">
        <x-header :active="$active ?? 'catalog'" />

        @yield('content')
    </div>
</body>
</html>
