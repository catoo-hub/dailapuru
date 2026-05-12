@extends('layouts.admin')

@section('title', 'Заказ #' . $order->id . ' — Админка')
@section('page_title', 'Заказ #' . $order->id)

@section('content')
    <div class="grid gap-6 xl:grid-cols-[1fr_380px]">
        <section class="rounded-lg bg-white p-6 shadow-sm">
            <div class="flex flex-wrap items-start justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-extrabold">Состав заказа</h2>
                    <p class="mt-1 text-sm font-semibold text-slate-600">{{ $order->created_at->format('d.m.Y H:i') }}</p>
                </div>
                <span class="rounded-chip bg-sky-100 px-4 py-2 text-xs font-extrabold text-sky-700">
                    {{ $order->statusLabel() }}
                </span>
            </div>

            <div class="mt-6 divide-y divide-slate-100">
                @foreach ($order->items as $item)
                    <div class="grid gap-4 py-4 md:grid-cols-[1fr_90px_130px_130px] md:items-center">
                        <div>
                            <div class="font-extrabold">{{ $item->product_name }}</div>
                            @if ($item->product)
                                <div class="text-xs font-semibold text-slate-500">Товар ID: {{ $item->product->id }}</div>
                            @endif
                        </div>
                        <div class="font-bold">{{ $item->qty }} шт.</div>
                        <div class="font-bold">{{ number_format((float) $item->price, 0, ',', ' ') }} ₽</div>
                        <div class="font-extrabold">{{ number_format((float) $item->price * $item->qty, 0, ',', ' ') }} ₽</div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 rounded-lg bg-slate-50 p-5 text-right text-2xl font-extrabold">
                Итого: {{ number_format((float) $order->total, 0, ',', ' ') }} ₽
            </div>
        </section>

        <aside class="space-y-6">
            <section class="rounded-lg bg-white p-6 shadow-sm">
                <h2 class="text-xl font-extrabold">Покупатель</h2>
                <dl class="mt-4 space-y-3 text-sm font-semibold text-slate-700">
                    <div><dt class="font-extrabold text-slate-950">Имя</dt><dd>{{ $order->customer_name }}</dd></div>
                    <div><dt class="font-extrabold text-slate-950">Телефон</dt><dd>{{ $order->customer_phone ?: 'Не указан' }}</dd></div>
                    <div><dt class="font-extrabold text-slate-950">Email</dt><dd>{{ $order->customer_email ?: 'Не указан' }}</dd></div>
                    <div><dt class="font-extrabold text-slate-950">Адрес</dt><dd>{{ $order->address_snapshot ?: 'Не указан' }}</dd></div>
                    <div><dt class="font-extrabold text-slate-950">Промокод</dt><dd>{{ $order->promocode?->code ?? 'Не применён' }}</dd></div>
                </dl>
            </section>

            <section class="rounded-lg bg-white p-6 shadow-sm">
                <h2 class="text-xl font-extrabold">Обработка</h2>
                <form method="POST" action="{{ route('admin.orders.update', $order) }}" class="mt-4 space-y-4">
                    @csrf
                    @method('PUT')

                    <label class="block">
                        <span class="text-sm font-bold text-slate-700">Статус</span>
                        <select name="status" class="mt-2 h-11 w-full rounded-lg border border-slate-200 px-3 text-sm font-bold outline-none focus:border-brand-blue">
                            @foreach ($statuses as $key => $label)
                                <option value="{{ $key }}" @selected($order->status === $key)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </label>

                    <label class="block">
                        <span class="text-sm font-bold text-slate-700">Комментарий администратора</span>
                        <textarea name="comment" rows="5" class="mt-2 w-full rounded-lg border border-slate-200 px-3 py-3 text-sm font-semibold outline-none focus:border-brand-blue">{{ old('comment', $order->comment) }}</textarea>
                    </label>

                    <button class="h-11 rounded-lg bg-brand-blue px-5 text-sm font-extrabold text-white">
                        Сохранить
                    </button>
                </form>
            </section>
        </aside>
    </div>
@endsection
