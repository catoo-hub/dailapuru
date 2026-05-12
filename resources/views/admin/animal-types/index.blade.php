@extends('layouts.admin')

@section('title', 'Виды животных — Админка')
@section('page_title', 'Виды животных')

@section('content')
    <section class="grid gap-6 xl:grid-cols-[420px_1fr]">
        <form method="POST" action="{{ route('admin.animal-types.store') }}" class="rounded-lg bg-white p-6 shadow-sm">
            @csrf
            <h2 class="text-xl font-extrabold">Новый вид</h2>
            <label class="mt-5 block">
                <span class="text-sm font-bold text-slate-700">Название</span>
                <input name="name" required class="mt-2 h-11 w-full rounded-lg border border-slate-200 px-4 outline-none focus:border-brand-blue">
            </label>
            <label class="mt-4 block">
                <span class="text-sm font-bold text-slate-700">Slug</span>
                <input name="slug" placeholder="Можно оставить пустым" class="mt-2 h-11 w-full rounded-lg border border-slate-200 px-4 outline-none focus:border-brand-blue">
            </label>
            <button class="mt-5 h-11 rounded-lg bg-brand-blue px-5 text-sm font-extrabold text-white">Создать</button>
        </form>

        <div class="overflow-hidden rounded-lg bg-white shadow-sm">
            <div class="border-b border-slate-200 p-5">
                <h2 class="text-xl font-extrabold">Список видов</h2>
            </div>
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50 text-left text-xs font-extrabold uppercase tracking-[0.08em] text-slate-500">
                    <tr>
                        <th class="px-5 py-3">Название</th>
                        <th class="px-5 py-3">Товары</th>
                        <th class="px-5 py-3">Действия</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($animalTypes as $animalType)
                        <tr>
                            <td class="px-5 py-4">
                                <form id="animal-type-{{ $animalType->id }}" method="POST" action="{{ route('admin.animal-types.update', $animalType) }}">
                                    @csrf
                                    @method('PUT')
                                </form>
                                <input form="animal-type-{{ $animalType->id }}" name="name" value="{{ $animalType->name }}" required class="h-10 w-56 rounded-lg border border-slate-200 px-3 font-semibold">
                                <input form="animal-type-{{ $animalType->id }}" name="slug" value="{{ $animalType->slug }}" class="mt-2 h-10 w-56 rounded-lg border border-slate-200 px-3 text-xs font-semibold">
                            </td>
                            <td class="px-5 py-4 font-extrabold">{{ $animalType->products_count }}</td>
                            <td class="px-5 py-4">
                                <div class="flex gap-2">
                                    <button form="animal-type-{{ $animalType->id }}" class="h-9 rounded-lg bg-brand-blue px-3 text-xs font-extrabold text-white">Сохранить</button>
                                    <form method="POST" action="{{ route('admin.animal-types.destroy', $animalType) }}">
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
    </section>
@endsection
