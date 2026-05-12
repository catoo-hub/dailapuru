@props([
    'promo' => null,
])

@php
    $title  = $promo['title']  ?? 'Акция';
    $period = $promo['period'] ?? null;
    $image  = $promo['image']  ?? null;
    $url    = $promo['url']    ?? '#';
@endphp

<a href="{{ $url }}" class="flex h-full w-full flex-col p-3">
    <div class="aspect-[490/362] w-full overflow-hidden rounded-card bg-brand-pink/40">
        @if ($image)
            <img src="{{ $image }}" alt="{{ $title }}"
                 class="h-full w-full object-cover"
                 loading="lazy">
        @endif
    </div>
    @if ($period)
        <div class="mt-4 text-base text-brand-black/80">{{ $period }}</div>
    @endif
    <h3 class="mt-2 font-display text-2xl leading-tight text-brand-black">{{ $title }}</h3>
</a>
