@extends('layouts.admin')

@section('title', 'Бренды — Админка')
@section('page_title', 'Бренды')

@section('content')
    <section class="grid gap-6 xl:grid-cols-[420px_1fr]">
        <form method="POST" action="{{ route('admin.brands.store') }}" enctype="multipart/form-data" class="rounded-lg bg-white p-6 shadow-sm">
            @csrf
            <h2 class="text-xl font-extrabold">Новый бренд</h2>
            <label class="mt-5 block">
                <span class="text-sm font-bold text-slate-700">Название</span>
                <input name="name" required class="mt-2 h-11 w-full rounded-lg border border-slate-200 px-4 outline-none focus:border-brand-blue">
            </label>
            <label class="mt-4 block">
                <span class="text-sm font-bold text-slate-700">Slug</span>
                <input name="slug" placeholder="Можно оставить пустым" class="mt-2 h-11 w-full rounded-lg border border-slate-200 px-4 outline-none focus:border-brand-blue">
            </label>
            <label class="mt-4 block">
                <span class="text-sm font-bold text-slate-700">Логотип</span>
                <input type="file" name="logo_file" accept="image/*" class="mt-2 block w-full rounded-lg border border-slate-200 px-4 py-3 text-sm">
            </label>
            <button class="mt-5 h-11 rounded-lg bg-brand-blue px-5 text-sm font-extrabold text-white">Создать</button>
        </form>

        <div class="overflow-hidden rounded-lg bg-white shadow-sm">
            <div class="border-b border-slate-200 p-5">
                <h2 class="text-xl font-extrabold">Список брендов</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-sm">
                    <thead class="bg-slate-50 text-left text-xs font-extrabold uppercase tracking-[0.08em] text-slate-500">
                        <tr>
                            <th class="px-5 py-3">Название</th>
                            <th class="px-5 py-3">Логотип</th>
                            <th class="px-5 py-3">Товары</th>
                            <th class="px-5 py-3">Действия</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($brands as $brand)
                            <tr>
                                <td class="px-5 py-4">
                                    <form id="brand-{{ $brand->id }}" method="POST" action="{{ route('admin.brands.update', $brand) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                    </form>
                                    <input form="brand-{{ $brand->id }}" name="name" value="{{ $brand->name }}" required class="h-10 w-56 rounded-lg border border-slate-200 px-3 font-semibold">
                                    <input form="brand-{{ $brand->id }}" name="slug" value="{{ $brand->slug }}" class="mt-2 h-10 w-56 rounded-lg border border-slate-200 px-3 text-xs font-semibold">
                                </td>
                                <td class="px-5 py-4">
                                    <input form="brand-{{ $brand->id }}" name="logo" value="{{ $brand->logo }}" placeholder="Путь логотипа" class="h-10 w-56 rounded-lg border border-slate-200 px-3 text-xs font-semibold">
                                    <input form="brand-{{ $brand->id }}" type="file" name="logo_file" accept="image/*" class="mt-2 block w-56 text-xs">
                                </td>
                                <td class="px-5 py-4 font-extrabold">{{ $brand->products_count }}</td>
                                <td class="px-5 py-4">
                                    <div class="flex gap-2">
                                        <button form="brand-{{ $brand->id }}" class="h-9 rounded-lg bg-brand-blue px-3 text-xs font-extrabold text-white">Сохранить</button>
                                        <form method="POST" action="{{ route('admin.brands.destroy', $brand) }}">
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
        </div>
    </section>
@endsection
