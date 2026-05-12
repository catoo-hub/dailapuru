@props([
    'title' => 'КОТОЛОГ',
])

<section class="relative overflow-hidden">
    <div class="relative mx-auto flex h-[613px] max-w-[1620px] items-start justify-center pt-2">
        {{-- Background stars --}}
        <div class="pointer-events-none absolute inset-0 z-10" aria-hidden="true">
            <img src="{{ asset('icons/Stars.svg') }}"
                 alt=""
                 class="h-full w-full object-contain"
                 onerror="this.style.display='none'">
        </div>

        {{-- Title --}}
        <h1 class="relative font-display text-[125px] leading-none text-brand-white">
            {{ $title }}
        </h1>

        {{-- Mascot --}}
        <div class="absolute left-1/2 top-[166px] z-20 -translate-x-1/2">
            <img src="{{ asset('images/hero-cat.png') }}"
                 alt=""
                 width="600" height="347"
                 class="select-none"
                 onerror="this.style.display='none'">
        </div>
    </div>
</section>
