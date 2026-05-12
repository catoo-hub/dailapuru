@extends('layouts.admin')

@section('title', 'Заказы — Админка')
@section('page_title', 'Заказы')

@section('content')
    <section class="rounded-lg bg-white shadow-sm">
        <div class="flex flex-wrap items-center justify-between gap-4 border-b border-slate-200 p-5">
            <div>
                <h2 class="text-xl font-extrabold">Заказы покупателей</h2>
                <p class="mt-1 text-sm font-semibold text-slate-600">Просмотр заказов и управление статусами.</p>
            </div>
        </div>

        <form method="GET" class="grid gap-3 border-b border-slate-200 p-5 md:grid-cols-[1fr_220px_120px]">
            <input name="q" value="{{ request('q') }}" placeholder="ID, имя, email или телефон"
                   class="h-11 rounded-lg border border-slate-200 px-4 text-sm font-bold outline-none focus:border-brand-blue">
            <select name="status" class="h-11 rounded-lg border border-slate-200 px-3 text-sm font-bold outline-none focus:border-brand-blue">
                <option value="">Все статусы</option>
                @foreach ($statuses as $key => $label)
                    <option value="{{ $key }}" @selected(request('status') === $key)>{{ $label }}</option>
                @endforeach
            </select>
            <button class="h-11 rounded-lg bg-slate-950 px-5 text-sm font-extrabold text-white">Найти</button>
        </form>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                <thead class="bg-slate-50 text-xs font-extrabold uppercase tracking-[0.08em] text-slate-500">
                    <tr>
                        <th class="px-5 py-3">Заказ</th>
                        <th class="px-5 py-3">Покупатель</th>
                        <th class="px-5 py-3">Сумма</th>
                        <th class="px-5 py-3">Статус</th>
                        <th class="px-5 py-3">Дата</th>
                        <th class="px-5 py-3">Действия</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($orders as $order)
                        <tr>
                            <td class="px-5 py-4 font-extrabold">#{{ $order->id }}</td>
                            <td class="px-5 py-4">
                                <div class="font-extrabold">{{ $order->customer_name }}</div>
                                <div class="text-xs font-semibold text-slate-500">{{ $order->customer_phone ?: $order->customer_email }}</div>
                            </td>
                            <td class="px-5 py-4 font-extrabold">{{ number_format((float) $order->total, 0, ',', ' ') }} ₽</td>
                            <td class="px-5 py-4">
                                <span class="rounded-chip bg-sky-100 px-3 py-1 text-xs font-extrabold text-sky-700">
                                    {{ $order->statusLabel() }}
                                </span>
                            </td>
                            <td class="px-5 py-4 text-slate-600">{{ $order->created_at->format('d.m.Y H:i') }}</td>
                            <td class="px-5 py-4">
                                <a href="{{ route('admin.orders.show', $order) }}"
                                   class="inline-flex h-9 items-center rounded-lg border border-slate-200 px-3 text-xs font-extrabold transition hover:bg-slate-50">
                                    Открыть
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-10 text-center font-bold text-slate-500">Заказов пока нет.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-slate-200 p-5">
            {{ $orders->links() }}
        </div>
    </section>
@endsection
