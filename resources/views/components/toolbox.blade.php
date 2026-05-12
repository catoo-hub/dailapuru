@props([
    'sort' => 'all',
    'sorts' => [
        'all'     => 'Все',
        'popular' => 'Популярные',
        'new'     => 'Новые',
    ],
    'filters' => [
        ['key' => 'brand',  'label' => 'Бренды'],
        ['key' => 'type',   'label' => 'Типы'],
        ['key' => 'animal', 'label' => 'Вид животного'],
    ],
])

<div class="flex h-[41px] items-center justify-between">
    {{-- Sort tabs --}}
    <div class="flex items-center gap-0 border-2 rounded-chip border-brand-white">
        @foreach ($sorts as $key => $label)
            <a href="?sort={{ $key }}"
               class="inline-flex h-[41px] items-center rounded-chip px-4 text-base font-medium transition
                      {{ $sort === $key
                            ? 'bg-brand-white text-brand-black'
                            : 'text-brand-white hover:bg-brand-blue-dark' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>

    {{-- Filter selects --}}
    <div class="flex items-center gap-2">
        @foreach ($filters as $filter)
            <button type="button"
                    class="inline-flex h-[41px] items-center gap-2 rounded-chip border-2 border-brand-white px-4 text-base font-medium text-brand-white">
                <span>{{ $filter['label'] }}</span>
                <x-icon color="text-brand-white" name="chevrons-up-down" size="16" />
            </button>
        @endforeach
    </div>
</div>
