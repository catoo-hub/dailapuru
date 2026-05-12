@extends('layouts.app', ['active' => 'catalog'])

@section('title', 'Дай Лапу — каталог зоомагазина')
@section('meta_description', 'Каталог товаров для животных: корма, аксессуары, средства ухода, игрушки. Доставка по городу.')

@section('content')
    <x-hero title="КОТОЛОГ" />

    <main class="p-[24px] bg-brand-blue rounded-t-[24px]">
        <x-toolbox sort="all" />

        <div class="mt-6">
            <x-product-grid :products="$products" />
        </div>

        <x-promo-slider :promotions="$promotions" />
    </main>
@endsection
