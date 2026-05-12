@extends('layouts.admin')

@section('title', 'Отзывы — Админка')
@section('page_title', 'Отзывы')

@section('content')
    <section class="rounded-lg bg-white shadow-sm">
        <div class="flex flex-wrap items-center justify-between gap-4 border-b border-slate-200 p-5">
            <div>
                <h2 class="text-xl font-extrabold">Модерация отзывов</h2>
                <p class="mt-1 text-sm font-semibold text-slate-600">Подтверждение, снятие с публикации и удаление.</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.reviews.index') }}" class="h-10 rounded-lg border border-slate-200 px-4 py-2 text-sm font-extrabold">Все</a>
                <a href="{{ route('admin.reviews.index', ['status' => 'pending']) }}" class="h-10 rounded-lg border border-slate-200 px-4 py-2 text-sm font-extrabold">На модерации</a>
                <a href="{{ route('admin.reviews.index', ['status' => 'approved']) }}" class="h-10 rounded-lg border border-slate-200 px-4 py-2 text-sm font-extrabold">Опубликованные</a>
            </div>
        </div>

        <div class="divide-y divide-slate-100">
            @forelse ($reviews as $review)
                <article class="p-5">
                    <div class="flex flex-wrap items-start justify-between gap-4">
                        <div>
                            <div class="font-extrabold">{{ $review->name }} · {{ $review->rating }}/5</div>
                            <div class="mt-1 text-sm font-semibold text-slate-500">
                                {{ $review->product?->name ?? 'Отзыв о магазине' }} · {{ $review->created_at->format('d.m.Y H:i') }}
                            </div>
                        </div>
                        <span class="rounded-chip px-3 py-1 text-xs font-extrabold {{ $review->approved ? 'bg-emerald-100 text-emerald-700' : 'bg-orange-100 text-orange-700' }}">
                            {{ $review->approved ? 'Опубликован' : 'На модерации' }}
                        </span>
                    </div>
                    <p class="mt-4 max-w-4xl text-sm font-semibold text-slate-700">{{ $review->body }}</p>
                    <div class="mt-4 flex gap-2">
                        @if (! $review->approved)
                            <form method="POST" action="{{ route('admin.reviews.approve', $review) }}">
                                @csrf
                                <button class="h-9 rounded-lg bg-brand-blue px-3 text-xs font-extrabold text-white">Опубликовать</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('admin.reviews.reject', $review) }}">
                                @csrf
                                <button class="h-9 rounded-lg border border-slate-200 px-3 text-xs font-extrabold">Снять</button>
                            </form>
                        @endif
                        <form method="POST" action="{{ route('admin.reviews.destroy', $review) }}">
                            @csrf
                            @method('DELETE')
                            <button class="h-9 rounded-lg border border-red-200 px-3 text-xs font-extrabold text-red-700">Удалить</button>
                        </form>
                    </div>
                </article>
            @empty
                <div class="p-10 text-center font-bold text-slate-500">Отзывов пока нет.</div>
            @endforelse
        </div>

        <div class="border-t border-slate-200 p-5">{{ $reviews->links() }}</div>
    </section>
@endsection
