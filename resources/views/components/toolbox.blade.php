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
    <div class="flex items-center gap-0 border-2 rounded-chip border-white">
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
                    class="inline-flex h-[41px] items-center gap-2 rounded-chip bg-brand-white px-4 text-base font-medium text-brand-black">
                <span>{{ $filter['label'] }}</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="6 9 12 15 18 9"/>
                </svg>
            </button>
        @endforeach
    </div>
</div>
