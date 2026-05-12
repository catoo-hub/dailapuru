@extends('layouts.admin')

@section('title', 'Настройки — Админка')
@section('page_title', 'Контакты и кнопка звонка')

@section('content')
    <section class="max-w-4xl rounded-lg bg-white p-6 shadow-sm">
        <h2 class="text-xl font-extrabold">Контактные данные магазина</h2>
        <p class="mt-2 text-sm font-semibold text-slate-600">Эти значения используются для страницы контактов и постоянной кнопки «Позвонить».</p>

        <form method="POST" action="{{ route('admin.settings.update') }}" class="mt-6 grid gap-5">
            @csrf
            @method('PUT')

            <label class="block">
                <span class="text-sm font-bold text-slate-700">Телефон для отображения</span>
                <input name="shop_phone" value="{{ old('shop_phone', $settings->get('shop_phone')) }}"
                       class="mt-2 h-12 w-full rounded-lg border border-slate-200 px-4 outline-none transition focus:border-brand-blue focus:ring-4 focus:ring-sky-100">
            </label>

            <label class="block">
                <span class="text-sm font-bold text-slate-700">Телефон для кнопки «Позвонить»</span>
                <input name="call_phone" value="{{ old('call_phone', $settings->get('call_phone')) }}"
                       class="mt-2 h-12 w-full rounded-lg border border-slate-200 px-4 outline-none transition focus:border-brand-blue focus:ring-4 focus:ring-sky-100">
            </label>

            <label class="block">
                <span class="text-sm font-bold text-slate-700">Email</span>
                <input type="email" name="shop_email" value="{{ old('shop_email', $settings->get('shop_email')) }}"
                       class="mt-2 h-12 w-full rounded-lg border border-slate-200 px-4 outline-none transition focus:border-brand-blue focus:ring-4 focus:ring-sky-100">
            </label>

            <label class="block">
                <span class="text-sm font-bold text-slate-700">Адрес</span>
                <input name="shop_address" value="{{ old('shop_address', $settings->get('shop_address')) }}"
                       class="mt-2 h-12 w-full rounded-lg border border-slate-200 px-4 outline-none transition focus:border-brand-blue focus:ring-4 focus:ring-sky-100">
            </label>

            <label class="block">
                <span class="text-sm font-bold text-slate-700">График работы</span>
                <input name="shop_working_hours" value="{{ old('shop_working_hours', $settings->get('shop_working_hours')) }}"
                       class="mt-2 h-12 w-full rounded-lg border border-slate-200 px-4 outline-none transition focus:border-brand-blue focus:ring-4 focus:ring-sky-100">
            </label>

            <button type="submit"
                    class="inline-flex h-11 w-fit items-center rounded-lg bg-brand-blue px-5 text-sm font-extrabold text-white transition hover:bg-brand-blue-dark">
                Сохранить настройки
            </button>
        </form>
    </section>
@endsection
