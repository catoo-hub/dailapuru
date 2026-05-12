@props([
    'products' => [],
])

@php
    // Bento layout: row A (2 big + 4 small), row B (4 equal), row A repeat
    // Required slots: 6 + 4 + 6 = 16; gracefully repeats $products if shorter.
    $get = function (int $i) use ($products) {
        return $products[$i % max(count($products), 1)] ?? null;
    };
@endphp

<div class="flex flex-col gap-10">
    {{-- Row A: two 765x500 bento modules --}}
    @foreach ([[0, 1, 2, 3, 4, 5], [10, 11, 12, 13, 14, 15]] as $rowIdx => $slots)
        <div class="grid grid-cols-[1fr_225px_1fr_225px] gap-10">
            {{-- big card 1 --}}
            <div class="aspect-square">
                <x-product-card :product="$get($slots[0])" size="lg" />
            </div>
            {{-- two small cards 1 --}}
            <div class="grid grid-rows-2 gap-10">
                <x-product-card :product="$get($slots[1])" size="sm" />
                <x-product-card :product="$get($slots[2])" size="sm" />
            </div>
            {{-- big card 2 --}}
            <div class="aspect-square">
                <x-product-card :product="$get($slots[3])" size="lg" />
            </div>
            {{-- two small cards 2 --}}
            <div class="grid grid-rows-2 gap-10">
                <x-product-card :product="$get($slots[4])" size="sm" />
                <x-product-card :product="$get($slots[5])" size="sm" />
            </div>
        </div>

        @if ($rowIdx === 0)
            {{-- Row B: 4 equal 362.5x362.5 cards --}}
            <div class="grid grid-cols-4 gap-10">
                @for ($i = 6; $i < 10; $i++)
                    <div class="aspect-square">
                        <x-product-card :product="$get($i)" size="md" />
                    </div>
                @endfor
            </div>
        @endif
    @endforeach
</div>
