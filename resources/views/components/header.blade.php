@props([
    'active' => 'catalog',
    'items' => [
        'catalog'    => ['label' => 'Каталог',  'url' => '/catalog'],
        'about'      => ['label' => 'О нас',    'url' => '/about'],
        'contacts'   => ['label' => 'Контакты', 'url' => '/contacts'],
        'articles'   => ['label' => 'Статьи',   'url' => '/articles'],
        'promotions' => ['label' => 'Акции',    'url' => '/promotions'],
        'reviews'    => ['label' => 'Отзывы',   'url' => '/reviews'],
    ],
])

<header class="flex h-[90px] items-center justify-between pt-2">
    <a href="/" class="flex items-center gap-2" aria-label="Дай Лапу">
        <img class="w-[90px] h-[90px]" src="/images/Dai_Lapu_Logo.png" alt="Дай Лапу">
    </a>

    <nav class="flex items-center gap-[24px]">
        <ul class="flex items-center bg-white/24 rounded-[24px]">
            @foreach ($items as $key => $item)
                <li>
                    <a href="{{ $item['url'] }}"
                       class="inline-flex h-[41px] items-center rounded-chip px-4 text-base font-medium transition
                              {{ $active === $key
                                    ? 'bg-brand-pink text-brand-white'
                                    : 'text-brand-white/95 hover:bg-brand-blue-dark' }}">
                        {{ $item['label'] }}
                    </a>
                </li>
            @endforeach
        </ul>

        <a href="/cart"
        class="ml-4 inline-flex h-[50px] w-[50px] items-center justify-center text-brand-white"
        aria-label="Корзина">
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/>
                <path d="M1 1h4l2.7 13.4a2 2 0 0 0 2 1.6h9.7a2 2 0 0 0 2-1.6L23 6H6"/>
            </svg>
        </a>

        <div class="flex items-center gap-2">
            @auth
                @if (auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}"
                       class="inline-flex h-[41px] items-center rounded-chip bg-white/20 px-4 text-sm font-bold text-brand-white transition hover:bg-white/30">
                        Админка
                    </a>
                @endif

                <a href="{{ route('account.dashboard') }}"
                   class="inline-flex h-[50px] w-[50px] items-center justify-center rounded-full bg-brand-white text-brand-blue"
                   aria-label="Личный кабинет">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                    </svg>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="inline-flex h-[41px] items-center rounded-chip bg-brand-pink px-4 text-sm font-bold text-white transition hover:bg-brand-pink-dark">
                        Выйти
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                   class="inline-flex h-[41px] items-center rounded-chip bg-brand-white px-4 text-sm font-bold text-brand-blue transition hover:bg-white/90">
                    Войти
                </a>
            @endauth
        </div>
    </nav>
</header>
