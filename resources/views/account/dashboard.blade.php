@extends('layouts.app', ['active' => 'account'])

@section('title', 'Личный кабинет — Дай Лапу')
@section('meta_description', 'Профиль покупателя, личные данные и заказы в зоомагазине Дай Лапу.')

@section('content')
    <main class="py-10 pb-28">
        <div class="rounded-[24px] bg-white p-8 shadow-xl">
            <div class="flex flex-wrap items-start justify-between gap-5">
                <div>
                    <p class="text-sm font-extrabold uppercase tracking-[0.16em] text-brand-blue">Личный кабинет</p>
                    <h1 class="mt-3 text-4xl font-extrabold text-slate-950">{{ $user->name }}</h1>
                    <p class="mt-2 text-slate-600">{{ $user->email }}</p>
                </div>

                @if ($user->isAdmin())
                    <a href="{{ route('admin.dashboard') }}"
                       class="inline-flex h-11 items-center rounded-lg bg-slate-950 px-5 text-sm font-extrabold text-white transition hover:bg-slate-800">
                        Перейти в админку
                    </a>
                @endif
            </div>

            @if (session('status'))
                <div class="mt-6 rounded-lg border border-emerald-200 bg-emerald-50 p-4 text-sm font-bold text-emerald-700">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mt-6 rounded-lg border border-red-200 bg-red-50 p-4 text-sm font-bold text-red-700">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="mt-8 grid gap-6 lg:grid-cols-[1fr_1fr]">
                <section class="rounded-lg border border-slate-200 p-6">
                    <h2 class="text-xl font-extrabold text-slate-950">Личные данные</h2>
                    <form method="POST" action="{{ route('account.profile.update') }}" class="mt-5 space-y-5">
                        @csrf
                        @method('PUT')

                        <label class="block">
                            <span class="text-sm font-bold text-slate-700">Имя</span>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                                   class="mt-2 h-12 w-full rounded-lg border border-slate-200 px-4 outline-none transition focus:border-brand-blue focus:ring-4 focus:ring-sky-100">
                        </label>

                        <label class="block">
                            <span class="text-sm font-bold text-slate-700">Email</span>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                                   class="mt-2 h-12 w-full rounded-lg border border-slate-200 px-4 outline-none transition focus:border-brand-blue focus:ring-4 focus:ring-sky-100">
                        </label>

                        <label class="block">
                            <span class="text-sm font-bold text-slate-700">Телефон</span>
                            <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}"
                                   class="mt-2 h-12 w-full rounded-lg border border-slate-200 px-4 outline-none transition focus:border-brand-blue focus:ring-4 focus:ring-sky-100">
                        </label>

                        <button type="submit"
                                class="inline-flex h-11 items-center rounded-lg bg-brand-blue px-5 text-sm font-extrabold text-white transition hover:bg-brand-blue-dark">
                            Сохранить
                        </button>
                    </form>
                </section>

                <section class="rounded-lg border border-slate-200 p-6">
                    <h2 class="text-xl font-extrabold text-slate-950">Смена пароля</h2>
                    <form method="POST" action="{{ route('account.password.update') }}" class="mt-5 space-y-5">
                        @csrf
                        @method('PUT')

                        <label class="block">
                            <span class="text-sm font-bold text-slate-700">Текущий пароль</span>
                            <input type="password" name="current_password" required
                                   class="mt-2 h-12 w-full rounded-lg border border-slate-200 px-4 outline-none transition focus:border-brand-blue focus:ring-4 focus:ring-sky-100">
                        </label>

                        <label class="block">
                            <span class="text-sm font-bold text-slate-700">Новый пароль</span>
                            <input type="password" name="password" required
                                   class="mt-2 h-12 w-full rounded-lg border border-slate-200 px-4 outline-none transition focus:border-brand-blue focus:ring-4 focus:ring-sky-100">
                        </label>

                        <label class="block">
                            <span class="text-sm font-bold text-slate-700">Повтор нового пароля</span>
                            <input type="password" name="password_confirmation" required
                                   class="mt-2 h-12 w-full rounded-lg border border-slate-200 px-4 outline-none transition focus:border-brand-blue focus:ring-4 focus:ring-sky-100">
                        </label>

                        <button type="submit"
                                class="inline-flex h-11 items-center rounded-lg bg-slate-950 px-5 text-sm font-extrabold text-white transition hover:bg-slate-800">
                            Обновить пароль
                        </button>
                    </form>
                </section>
            </div>

            <div class="mt-6 grid gap-6 lg:grid-cols-3">
                <section class="rounded-lg bg-[#e8f7f0] p-6">
                    <h2 class="text-lg font-extrabold text-slate-950">История заказов</h2>
                    <p class="mt-2 text-sm font-semibold text-slate-600">Здесь появятся заказы после подключения корзины и оформления.</p>
                </section>
                <section class="rounded-lg bg-[#fff3df] p-6">
                    <h2 class="text-lg font-extrabold text-slate-950">Адреса доставки</h2>
                    <p class="mt-2 text-sm font-semibold text-slate-600">Раздел подготовлен под управление адресами покупателя.</p>
                </section>
                <section class="rounded-lg bg-[#eef4ff] p-6">
                    <h2 class="text-lg font-extrabold text-slate-950">Избранное</h2>
                    <p class="mt-2 text-sm font-semibold text-slate-600">Сохранённые товары будут доступны после подключения каталога.</p>
                </section>
            </div>
        </div>
    </main>
@endsection
