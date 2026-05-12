@props([
    'promotions' => [],
])

<section class="mt-20" x-data="promoSlider">
    <div class="flex h-14 items-center justify-between">
        <h2 class="font-display text-5xl text-brand-white">Акции</h2>
        <a href="/promotions"
           class="inline-flex h-[41px] items-center gap-2 rounded-chip bg-brand-white px-4 text-base font-medium text-brand-black">
            <span>Смотреть все</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                 fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
            </svg>
        </a>
    </div>

    <div class="relative mt-4 rounded-card bg-brand-white p-6">
        <div class="grid grid-cols-3 gap-6" data-promo-track>
            @foreach ($promotions as $promo)
                <x-promo-card :promo="$promo" />
            @endforeach

            @if (empty($promotions))
                @for ($i = 0; $i < 3; $i++)
                    <x-promo-card :promo="['title' => 'Акция №' . ($i + 1), 'period' => 'c 1 мая по 31 мая']" />
                @endfor
            @endif
        </div>

        {{-- Arrows --}}
        <button type="button"
                data-promo-prev
                class="absolute left-[-32px] top-1/2 grid h-16 w-16 -translate-y-1/2 place-items-center rounded-full bg-brand-white shadow-md"
                aria-label="Назад">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                 fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                 class="text-brand-black">
                <polyline points="15 18 9 12 15 6"/>
            </svg>
        </button>
        <button type="button"
                data-promo-next
                class="absolute right-[-32px] top-1/2 grid h-16 w-16 -translate-y-1/2 place-items-center rounded-full bg-brand-white shadow-md"
                aria-label="Вперёд">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                 fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                 class="text-brand-black">
                <polyline points="9 18 15 12 9 6"/>
            </svg>
        </button>
    </div>
</section>
