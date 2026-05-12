@extends('layouts.admin')

@section('title', 'Админка — Дай Лапу')
@section('page_title', 'Панель управления')

@section('content')
    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
        @foreach ([
            ['label' => 'Пользователи', 'value' => $stats['users']],
            ['label' => 'Товары', 'value' => $stats['products']],
            ['label' => 'Статьи', 'value' => $stats['articles']],
            ['label' => 'Акции', 'value' => $stats['promotions']],
            ['label' => 'Заказы', 'value' => $stats['orders']],
            ['label' => 'Выручка', 'value' => number_format((float) $stats['revenue'], 0, ',', ' ') . ' ₽'],
            ['label' => 'Промокоды', 'value' => $stats['promocodes']],
            ['label' => 'Отзывы на модерации', 'value' => $stats['pending_reviews']],
            ['label' => 'Настройки', 'value' => $stats['settings']],
        ] as $stat)
            <section class="rounded-lg bg-white p-5 shadow-sm">
                <p class="text-sm font-bold text-slate-500">{{ $stat['label'] }}</p>
                <div class="mt-3 text-4xl font-extrabold">{{ $stat['value'] }}</div>
            </section>
        @endforeach
    </div>

    <section class="mt-6 rounded-lg bg-white p-6 shadow-sm">
        <div class="flex flex-wrap items-start justify-between gap-4">
            <div>
                <h2 class="text-2xl font-extrabold">Разделы из ТЗ</h2>
                <p class="mt-2 max-w-3xl text-sm font-semibold text-slate-600">
                    Авторизация, роли и вход в админку подключены. Ниже рабочие точки входа для управления каталогом, статьями, акциями, отзывами и настройками магазина.
                </p>
            </div>
            <a href="{{ route('admin.settings.edit') }}" class="inline-flex h-10 items-center rounded-lg bg-orange-500 px-4 text-sm font-extrabold text-white transition hover:bg-orange-600">
                Контакты магазина
            </a>
        </div>

        <div class="mt-6 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
            @foreach ([
                ['title' => 'Товары', 'route' => route('admin.products.index'), 'text' => 'Цены, остатки, изображения'],
                ['title' => 'Категории', 'route' => route('admin.categories.index'), 'text' => 'Иерархия каталога'],
                ['title' => 'Заказы', 'route' => route('admin.orders.index'), 'text' => 'Статусы и обработка'],
                ['title' => 'Статьи', 'route' => route('admin.articles.index'), 'text' => 'Советы и публикации'],
                ['title' => 'Акции', 'route' => route('admin.promotions.index'), 'text' => 'Скидки и сроки'],
                ['title' => 'Промокоды', 'route' => route('admin.promocodes.index'), 'text' => 'Скидки и лимиты'],
                ['title' => 'Отзывы', 'route' => route('admin.reviews.index'), 'text' => 'Модерация'],
                ['title' => 'Отчёты', 'route' => route('admin.reports.index'), 'text' => 'Продажи и популярные товары'],
            ] as $item)
                <a href="{{ $item['route'] }}" class="rounded-lg border border-slate-200 p-5 transition hover:border-brand-blue hover:bg-sky-50">
                    <h3 class="text-lg font-extrabold">{{ $item['title'] }}</h3>
                    <p class="mt-2 text-sm font-semibold text-slate-600">{{ $item['text'] }}</p>
                </a>
            @endforeach
        </div>
    </section>
@endsection
