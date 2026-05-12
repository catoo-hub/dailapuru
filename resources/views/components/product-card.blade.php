@props([
    'product' => null,
    'size' => 'lg', // lg | md | sm
])

@php
    $name  = $product['name']  ?? 'Корм №1';
    $image = $product['image'] ?? null;
    $slug  = $product['slug']  ?? '#';

    $sizeClasses = [
        'lg' => 'rounded-card p-3',
        'md' => 'rounded-card p-3',
        'sm' => 'rounded-card p-3',
    ][$size] ?? 'rounded-card p-3';

    $labelClasses = [
        'lg' => 'text-2xl',
        'md' => 'text-xl',
        'sm' => 'text-lg',
    ][$size] ?? 'text-xl';
@endphp

<a href="{{ url('/product/' . $slug) }}"
   class="group flex h-full w-full flex-col justify-between bg-brand-pink transition hover:bg-brand-pink-dark {{ $sizeClasses }}">
    <div class="flex flex-1 items-center justify-center overflow-hidden">
        @if ($image)
            <img src="{{ $image }}" alt="{{ $name }}"
                 class="max-h-full max-w-full object-contain transition group-hover:scale-[1.02]"
                 loading="lazy">
        @else
            <div class="grid h-full w-full place-items-center text-brand-white/60">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect x="3" y="3" width="18" height="18" rx="2"/>
                    <circle cx="9" cy="9" r="2"/><path d="m21 15-5-5L5 21"/>
                </svg>
            </div>
        @endif
    </div>
    <div class="mt-2 text-center font-display {{ $labelClasses }} text-brand-white">
        {{ $name }}
    </div>
</a>
