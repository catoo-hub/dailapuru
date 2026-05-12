@extends('layouts.admin')

@php($isEdit = $article->exists)

@section('title', ($isEdit ? 'Редактирование статьи' : 'Новая статья') . ' — Админка')
@section('page_title', $isEdit ? 'Редактирование статьи' : 'Новая статья')

@section('content')
    <form method="POST" action="{{ $isEdit ? route('admin.articles.update', $article) : route('admin.articles.store') }}" enctype="multipart/form-data" class="max-w-5xl rounded-lg bg-white p-6 shadow-sm">
        @csrf
        @if ($isEdit)
            @method('PUT')
        @endif

        <div class="grid gap-5 lg:grid-cols-2">
            <label class="block">
                <span class="text-sm font-bold text-slate-700">Заголовок</span>
                <input name="title" value="{{ old('title', $article->title) }}" required class="mt-2 h-12 w-full rounded-lg border border-slate-200 px-4 outline-none focus:border-brand-blue">
            </label>
            <label class="block">
                <span class="text-sm font-bold text-slate-700">Slug</span>
                <input name="slug" value="{{ old('slug', $article->slug) }}" placeholder="Можно оставить пустым" class="mt-2 h-12 w-full rounded-lg border border-slate-200 px-4 outline-none focus:border-brand-blue">
            </label>
        </div>

        <label class="mt-5 block">
            <span class="text-sm font-bold text-slate-700">Краткое описание</span>
            <textarea name="excerpt" rows="3" class="mt-2 w-full rounded-lg border border-slate-200 px-4 py-3 outline-none focus:border-brand-blue">{{ old('excerpt', $article->excerpt) }}</textarea>
        </label>

        <label class="mt-5 block">
            <span class="text-sm font-bold text-slate-700">Текст статьи</span>
            <textarea name="body" rows="12" class="mt-2 w-full rounded-lg border border-slate-200 px-4 py-3 outline-none focus:border-brand-blue">{{ old('body', $article->body) }}</textarea>
        </label>

        <div class="mt-5 grid gap-5 lg:grid-cols-2">
            <div>
                <span class="text-sm font-bold text-slate-700">Обложка</span>
                <input type="file" name="cover_file" accept="image/*" class="mt-2 block w-full rounded-lg border border-slate-200 px-4 py-3 text-sm">
                <input name="cover" value="{{ old('cover', $article->cover) }}" placeholder="/storage/articles/file.jpg" class="mt-2 h-12 w-full rounded-lg border border-slate-200 px-4 outline-none focus:border-brand-blue">
            </div>
            <label class="block">
                <span class="text-sm font-bold text-slate-700">Дата публикации</span>
                <input type="datetime-local" name="published_at" value="{{ old('published_at', $article->published_at?->format('Y-m-d\\TH:i')) }}" class="mt-2 h-12 w-full rounded-lg border border-slate-200 px-4 outline-none focus:border-brand-blue">
            </label>
        </div>

        <input type="hidden" name="published" value="0">
        <label class="mt-5 inline-flex items-center gap-2 text-sm font-extrabold text-slate-700">
            <input type="checkbox" name="published" value="1" @checked(old('published', (bool) $article->published_at)) class="h-5 w-5 rounded border-slate-300 text-brand-blue">
            Опубликована
        </label>

        <div class="mt-7 flex gap-3">
            <button class="inline-flex h-11 items-center rounded-lg bg-brand-blue px-5 text-sm font-extrabold text-white">
                {{ $isEdit ? 'Сохранить статью' : 'Создать статью' }}
            </button>
            <a href="{{ route('admin.articles.index') }}" class="inline-flex h-11 items-center rounded-lg border border-slate-200 px-5 text-sm font-extrabold">Назад</a>
        </div>
    </form>
@endsection
