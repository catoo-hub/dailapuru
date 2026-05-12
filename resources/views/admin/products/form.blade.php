@extends('layouts.admin')

@php($isEdit = $product->exists)

@section('title', ($isEdit ? 'Редактирование товара' : 'Новый товар') . ' — Админка')
@section('page_title', $isEdit ? 'Редактирование товара' : 'Новый товар')

@section('content')
    <form method="POST" action="{{ $isEdit ? route('admin.products.update', $product) : route('admin.products.store') }}" enctype="multipart/form-data" class="max-w-5xl rounded-lg bg-white p-6 shadow-sm">
        @csrf
        @if ($isEdit)
            @method('PUT')
        @endif

        <div class="grid gap-5 lg:grid-cols-2">
            <label class="block">
                <span class="text-sm font-bold text-slate-700">Название</span>
                <input name="name" value="{{ old('name', $product->name) }}" required
                       class="mt-2 h-12 w-full rounded-lg border border-slate-200 px-4 outline-none focus:border-brand-blue">
            </label>

            <label class="block">
                <span class="text-sm font-bold text-slate-700">Slug</span>
                <input name="slug" value="{{ old('slug', $product->slug) }}" placeholder="Можно оставить пустым"
                       class="mt-2 h-12 w-full rounded-lg border border-slate-200 px-4 outline-none focus:border-brand-blue">
            </label>

            <label class="block">
                <span class="text-sm font-bold text-slate-700">Категория</span>
                <select name="category_id" class="mt-2 h-12 w-full rounded-lg border border-slate-200 px-4 outline-none focus:border-brand-blue">
                    <option value="">Без категории</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected((int) old('category_id', $product->category_id) === $category->id)>
                            {{ $category->parent ? $category->parent->name . ' / ' : '' }}{{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </label>

            <label class="block">
                <span class="text-sm font-bold text-slate-700">Бренд</span>
                <select name="brand_id" class="mt-2 h-12 w-full rounded-lg border border-slate-200 px-4 outline-none focus:border-brand-blue">
                    <option value="">Без бренда</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}" @selected((int) old('brand_id', $product->brand_id) === $brand->id)>{{ $brand->name }}</option>
                    @endforeach
                </select>
            </label>

            <label class="block">
                <span class="text-sm font-bold text-slate-700">Вид животного</span>
                <select name="animal_type_id" class="mt-2 h-12 w-full rounded-lg border border-slate-200 px-4 outline-none focus:border-brand-blue">
                    <option value="">Не указан</option>
                    @foreach ($animalTypes as $animalType)
                        <option value="{{ $animalType->id }}" @selected((int) old('animal_type_id', $product->animal_type_id) === $animalType->id)>{{ $animalType->name }}</option>
                    @endforeach
                </select>
            </label>

            <label class="block">
                <span class="text-sm font-bold text-slate-700">Возрастная группа</span>
                <input name="age_group" value="{{ old('age_group', $product->age_group) }}" placeholder="Щенки, взрослые, пожилые"
                       class="mt-2 h-12 w-full rounded-lg border border-slate-200 px-4 outline-none focus:border-brand-blue">
            </label>

            <label class="block">
                <span class="text-sm font-bold text-slate-700">Цена</span>
                <input type="number" step="0.01" min="0" name="price" value="{{ old('price', $product->price) }}" required
                       class="mt-2 h-12 w-full rounded-lg border border-slate-200 px-4 outline-none focus:border-brand-blue">
            </label>

            <label class="block">
                <span class="text-sm font-bold text-slate-700">Старая цена</span>
                <input type="number" step="0.01" min="0" name="old_price" value="{{ old('old_price', $product->old_price) }}"
                       class="mt-2 h-12 w-full rounded-lg border border-slate-200 px-4 outline-none focus:border-brand-blue">
            </label>

            <label class="block">
                <span class="text-sm font-bold text-slate-700">Остаток</span>
                <input type="number" min="0" name="stock" value="{{ old('stock', $product->stock) }}" required
                       class="mt-2 h-12 w-full rounded-lg border border-slate-200 px-4 outline-none focus:border-brand-blue">
            </label>

            <div>
                <span class="text-sm font-bold text-slate-700">Изображение</span>
                <input type="file" name="image_file" accept="image/*"
                       class="mt-2 block w-full rounded-lg border border-slate-200 px-4 py-3 text-sm">
                <input name="image" value="{{ old('image', $product->image) }}" placeholder="/storage/products/file.jpg"
                       class="mt-2 h-12 w-full rounded-lg border border-slate-200 px-4 outline-none focus:border-brand-blue">
            </div>
        </div>

        <label class="mt-5 block">
            <span class="text-sm font-bold text-slate-700">Описание</span>
            <textarea name="description" rows="6" class="mt-2 w-full rounded-lg border border-slate-200 px-4 py-3 outline-none focus:border-brand-blue">{{ old('description', $product->description) }}</textarea>
        </label>

        <div class="mt-5 flex flex-wrap gap-5">
            @foreach ([
                'published' => 'Опубликован',
                'is_hit' => 'Хит продаж',
                'is_new' => 'Новинка',
            ] as $field => $label)
                <input type="hidden" name="{{ $field }}" value="0">
                <label class="inline-flex items-center gap-2 text-sm font-extrabold text-slate-700">
                    <input type="checkbox" name="{{ $field }}" value="1" @checked(old($field, $product->{$field}))
                           class="h-5 w-5 rounded border-slate-300 text-brand-blue">
                    {{ $label }}
                </label>
            @endforeach
        </div>

        <div class="mt-7 flex gap-3">
            <button class="inline-flex h-11 items-center rounded-lg bg-brand-blue px-5 text-sm font-extrabold text-white transition hover:bg-brand-blue-dark">
                {{ $isEdit ? 'Сохранить товар' : 'Создать товар' }}
            </button>
            <a href="{{ route('admin.products.index') }}" class="inline-flex h-11 items-center rounded-lg border border-slate-200 px-5 text-sm font-extrabold transition hover:bg-slate-50">
                Назад
            </a>
        </div>
    </form>
@endsection
