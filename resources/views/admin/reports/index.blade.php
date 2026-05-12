@extends('layouts.admin')

@section('title', 'Отчёты — Админка')
@section('page_title', 'Отчёты')

@section('content')
    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-5">
        @foreach ([
            ['label' => 'Заказы', 'value' => $summary['orders']],
            ['label' => 'Выручка', 'value' => number_format((float) $summary['revenue'], 0, ',', ' ') . ' ₽'],
            ['label' => 'Товары', 'value' => $summary['products']],
            ['label' => 'Пользователи', 'value' => $summary['users']],
            ['label' => 'Отзывы на модерации', 'value' => $summary['pending_reviews']],
        ] as $stat)
            <section class="rounded-lg bg-white p-5 shadow-sm">
                <p class="text-sm font-bold text-slate-500">{{ $stat['label'] }}</p>
                <div class="mt-3 text-3xl font-extrabold">{{ $stat['value'] }}</div>
            </section>
        @endforeach
    </div>

    <div class="mt-6 grid gap-6 xl:grid-cols-2">
        <section class="rounded-lg bg-white p-6 shadow-sm">
            <h2 class="text-xl font-extrabold">Заказы по статусам</h2>
            <div class="mt-5 space-y-3">
                @foreach ($statuses as $key => $label)
                    @php($count = (int) ($ordersByStatus[$key] ?? 0))
                    <div>
                        <div class="flex items-center justify-between text-sm font-bold">
                            <span>{{ $label }}</span>
                            <span>{{ $count }}</span>
                        </div>
                        <div class="mt-2 h-2 rounded-full bg-slate-100">
                            <div class="h-2 rounded-full bg-brand-blue" style="width: {{ min(100, $summary['orders'] ? ($count / $summary['orders']) * 100 : 0) }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="rounded-lg bg-white p-6 shadow-sm">
            <h2 class="text-xl font-extrabold">Популярные товары</h2>
            <div class="mt-5 divide-y divide-slate-100">
                @forelse ($popularProducts as $item)
                    <div class="grid grid-cols-[1fr_80px_120px] gap-3 py-3 text-sm">
                        <div class="font-extrabold">{{ $item->product_name }}</div>
                        <div class="font-bold">{{ $item->qty }} шт.</div>
                        <div class="text-right font-extrabold">{{ number_format((float) $item->revenue, 0, ',', ' ') }} ₽</div>
                    </div>
                @empty
                    <div class="py-8 text-center font-bold text-slate-500">Данных пока нет.</div>
                @endforelse
            </div>
        </section>
    </div>

    <section class="mt-6 rounded-lg bg-white p-6 shadow-sm">
        <h2 class="text-xl font-extrabold">Продажи за последние 14 дней</h2>
        <div class="mt-5 overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                <thead class="bg-slate-50 text-xs font-extrabold uppercase tracking-[0.08em] text-slate-500">
                    <tr>
                        <th class="px-5 py-3">Дата</th>
                        <th class="px-5 py-3">Заказы</th>
                        <th class="px-5 py-3">Выручка</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($salesByDay as $day)
                        <tr>
                            <td class="px-5 py-4 font-extrabold">{{ $day->day }}</td>
                            <td class="px-5 py-4">{{ $day->orders_count }}</td>
                            <td class="px-5 py-4 font-extrabold">{{ number_format((float) $day->revenue, 0, ',', ' ') }} ₽</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-5 py-10 text-center font-bold text-slate-500">Продаж за период нет.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
