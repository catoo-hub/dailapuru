@extends('layouts.admin')

@section('title', 'Статьи — Админка')
@section('page_title', 'Статьи')

@section('content')
    <section class="rounded-lg bg-white shadow-sm">
        <div class="flex flex-wrap items-center justify-between gap-4 border-b border-slate-200 p-5">
            <div>
                <h2 class="text-xl font-extrabold">Полезные статьи</h2>
                <p class="mt-1 text-sm font-semibold text-slate-600">Советы по уходу, выбору корма и аксессуаров.</p>
            </div>
            <a href="{{ route('admin.articles.create') }}" class="inline-flex h-10 items-center rounded-lg bg-brand-blue px-4 text-sm font-extrabold text-white">
                Добавить статью
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                <thead class="bg-slate-50 text-xs font-extrabold uppercase tracking-[0.08em] text-slate-500">
                    <tr>
                        <th class="px-5 py-3">Статья</th>
                        <th class="px-5 py-3">Публикация</th>
                        <th class="px-5 py-3">Действия</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($articles as $article)
                        <tr>
                            <td class="px-5 py-4">
                                <div class="font-extrabold">{{ $article->title }}</div>
                                <div class="mt-1 max-w-2xl text-sm text-slate-600">{{ $article->excerpt }}</div>
                            </td>
                            <td class="px-5 py-4">
                                @if ($article->published_at)
                                    <span class="rounded-chip bg-emerald-100 px-3 py-1 text-xs font-extrabold text-emerald-700">
                                        {{ $article->published_at->format('d.m.Y H:i') }}
                                    </span>
                                @else
                                    <span class="rounded-chip bg-slate-100 px-3 py-1 text-xs font-extrabold text-slate-500">Черновик</span>
                                @endif
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.articles.edit', $article) }}" class="h-9 rounded-lg border border-slate-200 px-3 py-2 text-xs font-extrabold">Редактировать</a>
                                    <form method="POST" action="{{ route('admin.articles.destroy', $article) }}">
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

        <div class="border-t border-slate-200 p-5">{{ $articles->links() }}</div>
    </section>
@endsection
