@extends('layouts.admin')

@section('title', 'Категории — Админка')
@section('page_title', 'Категории')

@section('content')
    <section class="grid gap-6 xl:grid-cols-[420px_1fr]">
        <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data" class="rounded-lg bg-white p-6 shadow-sm">
            @csrf
            <h2 class="text-xl font-extrabold">Новая категория</h2>
            <label class="mt-5 block">
                <span class="text-sm font-bold text-slate-700">Название</span>
                <input name="name" required class="mt-2 h-11 w-full rounded-lg border border-slate-200 px-4 outline-none focus:border-brand-blue">
            </label>
            <label class="mt-4 block">
                <span class="text-sm font-bold text-slate-700">Родитель</span>
                <select name="parent_id" class="mt-2 h-11 w-full rounded-lg border border-slate-200 px-4 outline-none focus:border-brand-blue">
                    <option value="">Без родителя</option>
                    @foreach ($parents as $parent)
                        <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                    @endforeach
                </select>
            </label>
            <label class="mt-4 block">
                <span class="text-sm font-bold text-slate-700">Slug</span>
                <input name="slug" placeholder="Можно оставить пустым" class="mt-2 h-11 w-full rounded-lg border border-slate-200 px-4 outline-none focus:border-brand-blue">
            </label>
            <label class="mt-4 block">
                <span class="text-sm font-bold text-slate-700">Сортировка</span>
                <input type="number" min="0" name="sort" value="0" class="mt-2 h-11 w-full rounded-lg border border-slate-200 px-4 outline-none focus:border-brand-blue">
            </label>
            <label class="mt-4 block">
                <span class="text-sm font-bold text-slate-700">Изображение</span>
                <input type="file" name="image_file" accept="image/*" class="mt-2 block w-full rounded-lg border border-slate-200 px-4 py-3 text-sm">
            </label>
            <button class="mt-5 h-11 rounded-lg bg-brand-blue px-5 text-sm font-extrabold text-white">Создать</button>
        </form>

        <div class="overflow-hidden rounded-lg bg-white shadow-sm">
            <div class="border-b border-slate-200 p-5">
                <h2 class="text-xl font-extrabold">Список категорий</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-sm">
                    <thead class="bg-slate-50 text-left text-xs font-extrabold uppercase tracking-[0.08em] text-slate-500">
                        <tr>
                            <th class="px-5 py-3">Название</th>
                            <th class="px-5 py-3">Родитель</th>
                            <th class="px-5 py-3">Товары</th>
                            <th class="px-5 py-3">Действия</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($categories as $category)
                            <tr>
                                <td class="px-5 py-4">
                                    <form id="category-{{ $category->id }}" method="POST" action="{{ route('admin.categories.update', $category) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                    </form>
                                    <input form="category-{{ $category->id }}" name="name" value="{{ $category->name }}" required class="h-10 w-56 rounded-lg border border-slate-200 px-3 font-semibold">
                                    <input form="category-{{ $category->id }}" name="slug" value="{{ $category->slug }}" class="mt-2 h-10 w-56 rounded-lg border border-slate-200 px-3 text-xs font-semibold">
                                    <input form="category-{{ $category->id }}" name="image" value="{{ $category->image }}" placeholder="Путь картинки" class="mt-2 h-10 w-56 rounded-lg border border-slate-200 px-3 text-xs font-semibold">
                                    <input form="category-{{ $category->id }}" type="file" name="image_file" accept="image/*" class="mt-2 block w-56 text-xs">
                                </td>
                                <td class="px-5 py-4">
                                    <select form="category-{{ $category->id }}" name="parent_id" class="h-10 w-52 rounded-lg border border-slate-200 px-3 font-semibold">
                                        <option value="">Без родителя</option>
                                        @foreach ($parents as $parent)
                                            <option value="{{ $parent->id }}" @selected($category->parent_id === $parent->id) @disabled($category->id === $parent->id)>{{ $parent->name }}</option>
                                        @endforeach
                                    </select>
                                    <input form="category-{{ $category->id }}" type="number" min="0" name="sort" value="{{ $category->sort }}" class="mt-2 h-10 w-52 rounded-lg border border-slate-200 px-3 font-semibold">
                                </td>
                                <td class="px-5 py-4 font-extrabold">{{ $category->products_count }}</td>
                                <td class="px-5 py-4">
                                    <div class="flex gap-2">
                                        <button form="category-{{ $category->id }}" class="h-9 rounded-lg bg-brand-blue px-3 text-xs font-extrabold text-white">Сохранить</button>
                                        <form method="POST" action="{{ route('admin.categories.destroy', $category) }}">
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
