@props([
    'title' => 'КОТОЛОГ',
])

<section class="relative overflow-hidden">
    <div class="relative mx-auto flex h-[613px] max-w-[1620px] items-start justify-center pt-2">
        {{-- Background stars --}}
        <div class="pointer-events-none absolute inset-0" aria-hidden="true">
            @foreach ([
                ['top' => '38px',  'left' => '370px',  'size' => 166, 'rot' => -10],
                ['top' => '206px', 'left' => '266px',  'size' => 168, 'rot' => 18],
                ['top' => '433px', 'left' => '417px',  'size' => 181, 'rot' => -8],
                ['top' => '0px',   'right' => '326px', 'size' => 152, 'rot' => 14],
                ['top' => '155px', 'right' => '197px', 'size' => 197, 'rot' => -16],
                ['top' => '354px', 'right' => '235px', 'size' => 190, 'rot' => 22],
            ] as $star)
                <span
                    class="absolute block text-brand-pink"
                    style="
                        @isset($star['top']) top: {{ $star['top'] }}; @endisset
                        @isset($star['left']) left: {{ $star['left'] }}; @endisset
                        @isset($star['right']) right: {{ $star['right'] }}; @endisset
                        width: {{ $star['size'] }}px; height: {{ $star['size'] }}px;
                        transform: rotate({{ $star['rot'] }}deg);
                    ">
                    <svg viewBox="0 0 100 100" fill="currentColor" class="h-full w-full">
                        <path d="M50 0 L61 35 L98 38 L68 60 L80 96 L50 75 L20 96 L32 60 L2 38 L39 35 Z"/>
                    </svg>
                </span>
            @endforeach
        </div>

        {{-- Title --}}
        <h1 class="relative z-10 font-display text-[160px] leading-none text-brand-white drop-shadow-[0_6px_0_rgba(0,0,0,0.05)]">
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
