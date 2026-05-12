@php
    $nav = [
        ['label' => 'Обзор', 'url' => route('admin.dashboard'), 'active' => request()->routeIs('admin.dashboard')],
        ['label' => 'Товары', 'url' => route('admin.products.index'), 'active' => request()->routeIs('admin.products.*')],
        ['label' => 'Категории', 'url' => route('admin.categories.index'), 'active' => request()->routeIs('admin.categories.*')],
        ['label' => 'Бренды', 'url' => route('admin.brands.index'), 'active' => request()->routeIs('admin.brands.*')],
        ['label' => 'Виды животных', 'url' => route('admin.animal-types.index'), 'active' => request()->routeIs('admin.animal-types.*')],
        ['label' => 'Заказы', 'url' => route('admin.orders.index'), 'active' => request()->routeIs('admin.orders.*')],
        ['label' => 'Статьи', 'url' => route('admin.articles.index'), 'active' => request()->routeIs('admin.articles.*')],
        ['label' => 'Акции', 'url' => route('admin.promotions.index'), 'active' => request()->routeIs('admin.promotions.*')],
        ['label' => 'Промокоды', 'url' => route('admin.promocodes.index'), 'active' => request()->routeIs('admin.promocodes.*')],
        ['label' => 'Отзывы', 'url' => route('admin.reviews.index'), 'active' => request()->routeIs('admin.reviews.*')],
        ['label' => 'Пользователи', 'url' => route('admin.users.index'), 'active' => request()->routeIs('admin.users.*')],
        ['label' => 'Настройки', 'url' => route('admin.settings.edit'), 'active' => request()->routeIs('admin.settings.*')],
        ['label' => 'Отчёты', 'url' => route('admin.reports.index'), 'active' => request()->routeIs('admin.reports.*')],
    ];
@endphp

<aside class="border-r border-slate-200 bg-white p-5">
    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
        <img src="{{ asset('images/Dai_Lapu_Logo.png') }}" alt="Дай Лапу" class="h-14 w-14">
        <div>
            <div class="text-lg font-extrabold leading-tight">Дай Лапу</div>
            <div class="text-xs font-bold uppercase tracking-[0.12em] text-slate-500">admin</div>
        </div>
    </a>

    <nav class="mt-8 space-y-1">
        @foreach ($nav as $item)
            <a href="{{ $item['url'] }}"
               class="flex h-11 items-center rounded-lg px-4 text-sm font-bold transition
                      {{ $item['active'] ? 'bg-brand-blue text-white' : 'text-slate-700 hover:bg-slate-100' }}">
                {{ $item['label'] }}
            </a>
        @endforeach
    </nav>
</aside>
