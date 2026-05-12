@extends('layouts.admin')

@section('title', $meta['title'] . ' — Админка')
@section('page_title', $meta['title'])

@section('content')
    <section class="rounded-lg bg-white p-6 shadow-sm">
        <div class="flex flex-wrap items-start justify-between gap-5">
            <div>
                <h2 class="text-2xl font-extrabold">{{ $meta['title'] }}</h2>
                <p class="mt-2 max-w-3xl text-sm font-semibold text-slate-600">{{ $meta['description'] }}</p>
            </div>
            <span class="rounded-chip bg-sky-100 px-4 py-2 text-xs font-extrabold uppercase tracking-[0.12em] text-sky-700">
                Следующий этап
            </span>
        </div>

        <div class="mt-6 grid gap-4 md:grid-cols-2 xl:grid-cols-4">
            @foreach ($meta['tasks'] as $task)
                <div class="rounded-lg border border-slate-200 p-5">
                    <div class="text-lg font-extrabold">{{ $task }}</div>
                    <p class="mt-2 text-sm font-semibold text-slate-500">Место подготовлено для CRUD-логики и таблиц базы данных.</p>
                </div>
            @endforeach
        </div>
    </section>
@endsection
