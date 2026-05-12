@extends('layouts.admin')

@section('title', 'Акции — Админка')
@section('page_title', 'Акции')

@section('content')
    <section class="rounded-lg bg-white shadow-sm">
        <div class="flex flex-wrap items-center justify-between gap-4 border-b border-slate-200 p-5">
            <div>
                <h2 class="text-xl font-extrabold">Акции и спецпредложения</h2>
                <p class="mt-1 text-sm font-semibold text-slate-600">Промо-баннеры, сроки действия и публикация.</p>
            </div>
            <a href="{{ route('admin.promotions.create') }}" class="inline-flex h-10 items-center rounded-lg bg-brand-blue px-4 text-sm font-extrabold text-white">
                Добавить акцию
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                <thead class="bg-slate-50 text-xs font-extrabold uppercase tracking-[0.08em] text-slate-500">
                    <tr>
                        <th class="px-5 py-3">Акция</th>
                        <th class="px-5 py-3">Период</th>
                        <th class="px-5 py-3">Статус</th>
                        <th class="px-5 py-3">Действия</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($promotions as $promotion)
                        <tr>
                            <td class="px-5 py-4">
                                <div class="font-extrabold">{{ $promotion->title }}</div>
                                <div class="mt-1 max-w-2xl text-sm text-slate-600">{{ $promotion->description }}</div>
                            </td>
                            <td class="px-5 py-4">{{ $promotion->period }}</td>
                            <td class="px-5 py-4">
                                <span class="rounded-chip px-3 py-1 text-xs font-extrabold {{ $promotion->published ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-500' }}">
                                    {{ $promotion->published ? 'Опубликована' : 'Скрыта' }}
                                </span>
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.promotions.edit', $promotion) }}" class="h-9 rounded-lg border border-slate-200 px-3 py-2 text-xs font-extrabold">Редактировать</a>
                                    <form method="POST" action="{{ route('admin.promotions.destroy', $promotion) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="h-9 rounded-lg border border-red-200 px-3 text-xs font-extrabold text-red-700">Удалить</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="border-t border-slate-200 p-5">{{ $promotions->links() }}</div>
    </section>
@endsection
