@extends('layouts.admin')

@section('title', 'Промокоды — Админка')
@section('page_title', 'Промокоды')

@section('content')
    <section class="grid gap-6 xl:grid-cols-[420px_1fr]">
        <form method="POST" action="{{ route('admin.promocodes.store') }}" class="rounded-lg bg-white p-6 shadow-sm">
            @csrf
            <h2 class="text-xl font-extrabold">Новый промокод</h2>

            <label class="mt-5 block">
                <span class="text-sm font-bold text-slate-700">Код</span>
                <input name="code" required placeholder="LAPU10"
                       class="mt-2 h-11 w-full rounded-lg border border-slate-200 px-4 uppercase outline-none focus:border-brand-blue">
            </label>

            <label class="mt-4 block">
                <span class="text-sm font-bold text-slate-700">Скидка, %</span>
                <input type="number" min="1" max="90" name="discount_percent" value="10" required
                       class="mt-2 h-11 w-full rounded-lg border border-slate-200 px-4 outline-none focus:border-brand-blue">
            </label>

            <label class="mt-4 block">
                <span class="text-sm font-bold text-slate-700">Действует до</span>
                <input type="date" name="valid_until"
                       class="mt-2 h-11 w-full rounded-lg border border-slate-200 px-4 outline-none focus:border-brand-blue">
            </label>

            <label class="mt-4 block">
                <span class="text-sm font-bold text-slate-700">Лимит использований</span>
                <input type="number" min="1" name="usage_limit"
                       class="mt-2 h-11 w-full rounded-lg border border-slate-200 px-4 outline-none focus:border-brand-blue">
            </label>

            <input type="hidden" name="active" value="0">
            <label class="mt-5 inline-flex items-center gap-2 text-sm font-extrabold text-slate-700">
                <input type="checkbox" name="active" value="1" checked class="h-5 w-5 rounded border-slate-300 text-brand-blue">
                Активен
            </label>

            <button class="mt-5 h-11 rounded-lg bg-brand-blue px-5 text-sm font-extrabold text-white">Создать</button>
        </form>

        <div class="overflow-hidden rounded-lg bg-white shadow-sm">
            <div class="border-b border-slate-200 p-5">
                <h2 class="text-xl font-extrabold">Список промокодов</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                    <thead class="bg-slate-50 text-xs font-extrabold uppercase tracking-[0.08em] text-slate-500">
                        <tr>
                            <th class="px-5 py-3">Код</th>
                            <th class="px-5 py-3">Скидка</th>
                            <th class="px-5 py-3">Лимит</th>
                            <th class="px-5 py-3">Статус</th>
                            <th class="px-5 py-3">Действия</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($promocodes as $promocode)
                            <tr>
                                <td class="px-5 py-4">
                                    <form id="promocode-{{ $promocode->id }}" method="POST" action="{{ route('admin.promocodes.update', $promocode) }}">
                                        @csrf
                                        @method('PUT')
                                    </form>
                                    <input form="promocode-{{ $promocode->id }}" name="code" value="{{ $promocode->code }}" required
                                           class="h-10 w-36 rounded-lg border border-slate-200 px-3 font-extrabold uppercase">
                                    <input form="promocode-{{ $promocode->id }}" type="date" name="valid_until" value="{{ $promocode->valid_until?->format('Y-m-d') }}"
                                           class="mt-2 h-10 w-36 rounded-lg border border-slate-200 px-3 text-xs font-semibold">
                                </td>
                                <td class="px-5 py-4">
                                    <input form="promocode-{{ $promocode->id }}" type="number" min="1" max="90" name="discount_percent" value="{{ $promocode->discount_percent }}"
                                           class="h-10 w-24 rounded-lg border border-slate-200 px-3 font-bold">
                                </td>
                                <td class="px-5 py-4">
                                    <input form="promocode-{{ $promocode->id }}" type="number" min="1" name="usage_limit" value="{{ $promocode->usage_limit }}"
                                           class="h-10 w-24 rounded-lg border border-slate-200 px-3 font-bold">
                                    <input form="promocode-{{ $promocode->id }}" type="number" min="0" name="used_count" value="{{ $promocode->used_count }}"
                                           class="mt-2 h-10 w-24 rounded-lg border border-slate-200 px-3 text-xs font-bold">
                                </td>
                                <td class="px-5 py-4">
                                    <input form="promocode-{{ $promocode->id }}" type="hidden" name="active" value="0">
                                    <label class="inline-flex items-center gap-2 font-bold">
                                        <input form="promocode-{{ $promocode->id }}" type="checkbox" name="active" value="1" @checked($promocode->active)
                                               class="h-5 w-5 rounded border-slate-300 text-brand-blue">
                                        {{ $promocode->isAvailable() ? 'Доступен' : 'Недоступен' }}
                                    </label>
                                </td>
                                <td class="px-5 py-4">
                                    <div class="flex gap-2">
                                        <button form="promocode-{{ $promocode->id }}" class="h-9 rounded-lg bg-brand-blue px-3 text-xs font-extrabold text-white">Сохранить</button>
                                        <form method="POST" action="{{ route('admin.promocodes.destroy', $promocode) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="h-9 rounded-lg border border-red-200 px-3 text-xs font-extrabold text-red-700">Удалить</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-5 py-10 text-center font-bold text-slate-500">Промокодов пока нет.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
