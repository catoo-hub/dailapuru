@extends('layouts.admin')

@php($isEdit = $promotion->exists)

@section('title', ($isEdit ? 'Редактирование акции' : 'Новая акция') . ' — Админка')
@section('page_title', $isEdit ? 'Редактирование акции' : 'Новая акция')

@section('content')
    <form method="POST" action="{{ $isEdit ? route('admin.promotions.update', $promotion) : route('admin.promotions.store') }}" enctype="multipart/form-data" class="max-w-5xl rounded-lg bg-white p-6 shadow-sm">
        @csrf
        @if ($isEdit)
            @method('PUT')
        @endif

        <div class="grid gap-5 lg:grid-cols-2">
            <label class="block">
                <span class="text-sm font-bold text-slate-700">Название</span>
                <input name="title" value="{{ old('title', $promotion->title) }}" required class="mt-2 h-12 w-full rounded-lg border border-slate-200 px-4 outline-none focus:border-brand-blue">
            </label>
            <label class="block">
                <span class="text-sm font-bold text-slate-700">Slug</span>
                <input name="slug" value="{{ old('slug', $promotion->slug) }}" placeholder="Можно оставить пустым" class="mt-2 h-12 w-full rounded-lg border border-slate-200 px-4 outline-none focus:border-brand-blue">
            </label>
            <label class="block">
                <span class="text-sm font-bold text-slate-700">Начало</span>
                <input type="date" name="starts_at" value="{{ old('starts_at', $promotion->starts_at?->format('Y-m-d')) }}" class="mt-2 h-12 w-full rounded-lg border border-slate-200 px-4 outline-none focus:border-brand-blue">
            </label>
            <label class="block">
                <span class="text-sm font-bold text-slate-700">Окончание</span>
                <input type="date" name="ends_at" value="{{ old('ends_at', $promotion->ends_at?->format('Y-m-d')) }}" class="mt-2 h-12 w-full rounded-lg border border-slate-200 px-4 outline-none focus:border-brand-blue">
            </label>
        </div>

        <label class="mt-5 block">
            <span class="text-sm font-bold text-slate-700">Описание</span>
            <textarea name="description" rows="7" class="mt-2 w-full rounded-lg border border-slate-200 px-4 py-3 outline-none focus:border-brand-blue">{{ old('description', $promotion->description) }}</textarea>
        </label>

        <div class="mt-5">
            <span class="text-sm font-bold text-slate-700">Изображение</span>
            <input type="file" name="image_file" accept="image/*" class="mt-2 block w-full rounded-lg border border-slate-200 px-4 py-3 text-sm">
            <input name="image" value="{{ old('image', $promotion->image) }}" placeholder="/storage/promotions/file.jpg" class="mt-2 h-12 w-full rounded-lg border border-slate-200 px-4 outline-none focus:border-brand-blue">
        </div>

        <input type="hidden" name="published" value="0">
        <label class="mt-5 inline-flex items-center gap-2 text-sm font-extrabold text-slate-700">
            <input type="checkbox" name="published" value="1" @checked(old('published', $promotion->published)) class="h-5 w-5 rounded border-slate-300 text-brand-blue">
            Опубликована
        </label>

        <div class="mt-7 flex gap-3">
            <button class="inline-flex h-11 items-center rounded-lg bg-brand-blue px-5 text-sm font-extrabold text-white">
                {{ $isEdit ? 'Сохранить акцию' : 'Создать акцию' }}
            </button>
            <a href="{{ route('admin.promotions.index') }}" class="inline-flex h-11 items-center rounded-lg border border-slate-200 px-5 text-sm font-extrabold">Назад</a>
        </div>
    </form>
@endsection
