@extends('layouts.app', ['active' => 'account'])

@section('title', 'Регистрация — Дай Лапу')
@section('meta_description', 'Регистрация покупателя в зоомагазине Дай Лапу.')

@section('content')
    <main class="mx-auto grid min-h-[calc(100vh-140px)] max-w-[1120px] items-center py-12">
        <section class="grid overflow-hidden rounded-[24px] bg-white shadow-xl md:grid-cols-[1fr_460px]">
            <div class="bg-[#fff3df] p-8 md:p-12">
                <p class="text-sm font-extrabold uppercase tracking-[0.16em] text-orange-700">Новый покупатель</p>
                <h1 class="mt-4 text-4xl font-extrabold leading-tight text-slate-950">Создайте личный кабинет</h1>
                <p class="mt-4 max-w-xl text-lg text-slate-700">
                    Сохраняйте контактные данные, следите за заказами и быстрее оформляйте покупки для питомцев.
                </p>
            </div>

            <form method="POST" action="{{ route('register.store') }}" class="p-8 md:p-10">
                @csrf

                <h2 class="text-2xl font-extrabold text-slate-950">Регистрация</h2>

                @if ($errors->any())
                    <div class="mt-5 rounded-lg border border-red-200 bg-red-50 p-4 text-sm font-semibold text-red-700">
                        {{ $errors->first() }}
                    </div>
                @endif

                <label class="mt-6 block">
                    <span class="text-sm font-bold text-slate-700">Имя</span>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus
                           class="mt-2 h-12 w-full rounded-lg border border-slate-200 px-4 text-base outline-none transition focus:border-brand-blue focus:ring-4 focus:ring-sky-100">
                </label>

                <label class="mt-5 block">
                    <span class="text-sm font-bold text-slate-700">Email</span>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="mt-2 h-12 w-full rounded-lg border border-slate-200 px-4 text-base outline-none transition focus:border-brand-blue focus:ring-4 focus:ring-sky-100">
                </label>

                <label class="mt-5 block">
                    <span class="text-sm font-bold text-slate-700">Телефон</span>
                    <input type="tel" name="phone" value="{{ old('phone') }}"
                           class="mt-2 h-12 w-full rounded-lg border border-slate-200 px-4 text-base outline-none transition focus:border-brand-blue focus:ring-4 focus:ring-sky-100">
                </label>

                <label class="mt-5 block">
                    <span class="text-sm font-bold text-slate-700">Пароль</span>
                    <input type="password" name="password" required
                           class="mt-2 h-12 w-full rounded-lg border border-slate-200 px-4 text-base outline-none transition focus:border-brand-blue focus:ring-4 focus:ring-sky-100">
                </label>

                <label class="mt-5 block">
                    <span class="text-sm font-bold text-slate-700">Повтор пароля</span>
                    <input type="password" name="password_confirmation" required
                           class="mt-2 h-12 w-full rounded-lg border border-slate-200 px-4 text-base outline-none transition focus:border-brand-blue focus:ring-4 focus:ring-sky-100">
                </label>

                <button type="submit"
                        class="mt-7 inline-flex h-12 w-full items-center justify-center rounded-lg bg-orange-500 px-5 text-base font-extrabold text-white transition hover:bg-orange-600">
                    Создать аккаунт
                </button>

                <p class="mt-6 text-center text-sm font-semibold text-slate-600">
                    Уже есть аккаунт?
                    <a href="{{ route('login') }}" class="text-brand-blue hover:underline">Войти</a>
                </p>
            </form>
        </section>
    </main>
@endsection
