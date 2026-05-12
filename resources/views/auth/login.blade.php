@extends('layouts.app', ['active' => 'account'])

@section('title', 'Вход — Дай Лапу')
@section('meta_description', 'Вход в личный кабинет покупателя зоомагазина Дай Лапу.')

@section('content')
    <main class="mx-auto grid min-h-[calc(100vh-140px)] max-w-[1120px] items-center py-12">
        <section class="grid overflow-hidden rounded-[24px] bg-white shadow-xl md:grid-cols-[1fr_420px]">
            <div class="bg-[#e8f7f0] p-8 md:p-12">
                <p class="text-sm font-extrabold uppercase tracking-[0.16em] text-emerald-700">Личный кабинет</p>
                <h1 class="mt-4 text-4xl font-extrabold leading-tight text-slate-950">Войдите, чтобы продолжить покупки</h1>
                <p class="mt-4 max-w-xl text-lg text-slate-700">
                    После входа будут доступны профиль, история заказов, адреса доставки и избранные товары.
                </p>
                <div class="mt-8 rounded-lg bg-white/70 p-5 text-sm font-semibold text-slate-700">
                    Для теста администратора используйте: admin@dailapu.test / password
                </div>
            </div>

            <form method="POST" action="{{ route('login.store') }}" class="p-8 md:p-10">
                @csrf

                <h2 class="text-2xl font-extrabold text-slate-950">Вход</h2>

                @if ($errors->any())
                    <div class="mt-5 rounded-lg border border-red-200 bg-red-50 p-4 text-sm font-semibold text-red-700">
                        {{ $errors->first() }}
                    </div>
                @endif

                <label class="mt-6 block">
                    <span class="text-sm font-bold text-slate-700">Email</span>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="mt-2 h-12 w-full rounded-lg border border-slate-200 px-4 text-base outline-none transition focus:border-brand-blue focus:ring-4 focus:ring-sky-100">
                </label>

                <label class="mt-5 block">
                    <span class="text-sm font-bold text-slate-700">Пароль</span>
                    <input type="password" name="password" required
                           class="mt-2 h-12 w-full rounded-lg border border-slate-200 px-4 text-base outline-none transition focus:border-brand-blue focus:ring-4 focus:ring-sky-100">
                </label>

                <label class="mt-5 flex items-center gap-3 text-sm font-semibold text-slate-700">
                    <input type="checkbox" name="remember" value="1" class="h-5 w-5 rounded border-slate-300 text-brand-blue">
                    Запомнить меня
                </label>

                <button type="submit"
                        class="mt-7 inline-flex h-12 w-full items-center justify-center rounded-lg bg-brand-blue px-5 text-base font-extrabold text-white transition hover:bg-brand-blue-dark">
                    Войти
                </button>

                <p class="mt-6 text-center text-sm font-semibold text-slate-600">
                    Нет аккаунта?
                    <a href="{{ route('register') }}" class="text-brand-blue hover:underline">Зарегистрироваться</a>
                </p>
            </form>
        </section>
    </main>
@endsection
