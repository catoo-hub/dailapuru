@extends('layouts.error')

@section('title', '404 — Страница не найдена')
@section('meta_description', 'Запрошенная страница не найдена. Перейдите в каталог «Дай Лапу».')

@section('content')
    <main class="min-h-screen overflow-hidden bg-brand-blue">
        <div class="relative isolate min-h-screen overflow-hidden sn:w-[100dvw] lg:w-[80dvw] mx-auto">
            <div aria-hidden="true" class="absolute inset-0" style="background-image: radial-gradient(circle, #fff, #0000 50%);"></div>

            {{-- Background stars --}}
            <div class="pointer-events-none absolute inset-0 z-10 hidden md:block" aria-hidden="true">
                <img src="{{ asset('icons/Stars.svg') }}"
                    alt=""
                    class="h-full w-full object-contain"
                    onerror="this.style.display='none'">
            </div>

            <div class="relative mx-auto flex min-h-screen w-full max-w-[1620px] flex-col items-center justify-center px-6 py-10 text-center">
                <h1 class="font-display text-[48px] leading-none text-brand-white sm:text-[80px] lg:text-[120px]">
                    ОШИБКА
                </h1>

                <div class="mt-2 w-full max-w-[640px]">
                    <img src="{{ asset('images/error-cat.png') }}"
                        alt=""
                        class="mx-auto w-full select-none object-cover"
                        onerror="this.style.display='none'">
                </div>

                <p class="mt-2 max-w-[620px] text-[14px] leading-6 text-brand-white sm:text-xl sm:leading-8">
                    Похоже, эта страница убежала. Зато каталог с кормами, игрушками и вкусняшками на месте.
                </p>

                <p class="mt-2 font-display text-[24px] leading-none text-brand-white sm:text-[64px] lg:text-[90px]">
                    404
                </p>

                <div class="mt-6">
                    <a href="{{ url('/') }}"
                    class="inline-flex items-center gap-3 rounded-chip bg-brand-white px-3 py-2 text-[12px] font-extrabold text-brand-blue-dark transition hover:bg-brand-pink hover:text-brand-white">
                        <span>Вернуться в каталог</span>
                        <x-icon name="arrow-right" size="16" color="currentColor" />
                    </a>
                </div>
            </div>
        </div>
    </main>
@endsection
