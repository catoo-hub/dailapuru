@extends('layouts.admin')

@section('title', 'Товары — Админка')
@section('page_title', 'Товары')

@section('content')
    <section class="rounded-lg bg-white shadow-sm">
        <div class="flex flex-wrap items-center justify-between gap-4 border-b border-slate-200 p-5">
            <div>
                <h2 class="text-xl font-extrabold">Каталог товаров</h2>
                <p class="mt-1 text-sm font-semibold text-slate-600">Создание, цены, остатки, публикация и признаки «хит»/«новинка».</p>
            </div>
            <a href="{{ route('admin.products.create') }}" class="inline-flex h-10 items-center rounded-lg bg-brand-blue px-4 text-sm font-extrabold text-white transition hover:bg-brand-blue-dark">
                Добавить товар
            </a>
        </div>

        <form method="GET" class="border-b border-slate-200 p-5">
            <div class="flex max-w-xl gap-3">
                <input name="q" value="{{ request('q') }}" placeholder="Поиск по названию"
                       class="h-11 flex-1 rounded-lg border border-slate-200 px-4 outline-none focus:border-brand-blue">
                <button class="h-11 rounded-lg bg-slate-950 px-5 text-sm font-extrabold text-white">Найти</button>
            </div>
        </form>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                <thead class="bg-slate-50 text-xs font-extrabold uppercase tracking-[0.08em] text-slate-500">
                    <tr>
                        <th class="px-5 py-3">Товар</th>
                        <th class="px-5 py-3">Категория</th>
                        <th class="px-5 py-3">Цена</th>
                        <th class="px-5 py-3">Остаток</th>
                        <th class="px-5 py-3">Статус</th>
                        <th class="px-5 py-3">Действия</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($products as $product)
                        <tr>
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="grid h-14 w-14 place-items-center overflow-hidden rounded-lg bg-slate-100">
                                        @if ($product->image)
                                            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                                        @else
                                            <span class="text-xs font-bold text-slate-400">нет</span>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="font-extrabold">{{ $product->name }}</div>
                                        <div class="text-xs font-bold text-slate-500">slug: {{ $product->slug }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-4 text-slate-600">
                                {{ $product->category?->name ?? 'Без категории' }}
                                @if ($product->brand)
                                    <div class="text-xs">{{ $product->brand->name }}</div>
                                @endif
                            </td>
                            <td class="px-5 py-4 font-extrabold">{{ number_format((float) $product->price, 0, ',', ' ') }} ₽</td>
                            <td class="px-5 py-4">{{ $product->stock }}</td>
                            <td class="px-5 py-4">
                                <div class="flex flex-wrap gap-1">
                                    <span class="rounded-chip px-3 py-1 text-xs font-extrabold {{ $product->published ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-500' }}">
                                        {{ $product->published ? 'Опубликован' : 'Скрыт' }}
                                    </span>
                                    @if ($product->is_hit)
                                        <span class="rounded-chip bg-orange-100 px-3 py-1 text-xs font-extrabold text-orange-700">Хит</span>
                                    @endif
                                    @if ($product->is_new)
                                        <span class="rounded-chip bg-sky-100 px-3 py-1 text-xs font-extrabold text-sky-700">Новинка</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="inline-flex h-9 items-center rounded-lg border border-slate-200 px-3 text-xs font-extrabold transition hover:bg-slate-50">
                                        Редактировать
                                    </a>
                                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="inline-flex h-9 items-center rounded-lg border border-red-200 px-3 text-xs font-extrabold text-red-700 transition hover:bg-red-50">
                                            Удалить
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-10 text-center font-bold text-slate-500">Товаров пока нет.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-slate-200 p-5">
            {{ $products->links() }}
        </div>
    </section>
@endsection
