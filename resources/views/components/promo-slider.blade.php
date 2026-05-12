@props([
    'promotions' => [],
])

<section class="mt-20" x-data="promoSlider">
    <div class="flex h-14 items-center justify-between">
        <h2 class="font-display text-5xl text-brand-white">Акции</h2>
        <a href="/promotions"
           class="inline-flex h-[41px] items-center gap-2 rounded-chip border-2 border-brand-white px-4 text-base font-medium text-brand-white">
            <span>Смотреть все</span>
            <x-icon color="text-brand-white" name="arrow-down-right" size="16" />
        </a>
    </div>

    <div class="relative mt-4 rounded-card" style="background: linear-gradient(90deg,rgba(0, 135, 231, 0.8) 0%, rgba(0, 168, 255, 0) 50%, rgba(0, 135, 231, 0.8) 100%);">
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
                class="absolute left-0 top-1/2 grid w-16 -translate-y-1/2 place-items-center rounded-full cursor-pointer"
                aria-label="Назад">
            <img src="/icons/slider-left.svg" alt="">
        </button>
        <button type="button"
                data-promo-next
                class="absolute right-0 top-1/2 grid w-16 -translate-y-1/2 place-items-center rounded-full cursor-pointer"
                aria-label="Вперёд">
            <img src="/icons/slider-right.svg" alt="">    
        </button>
    </div>
</section>
