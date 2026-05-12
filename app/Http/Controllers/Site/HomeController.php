<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $products = array_map(
            fn (int $i) => [
                'slug'  => 'korm-' . $i,
                'name'  => 'Корм №' . $i,
                'image' => null,
            ],
            range(1, 16),
        );

        $promotions = [
            [
                'title'  => 'Сухой корм и влажный корм для кошек и собак',
                'period' => 'c 1 мая по 31 августа',
                'image'  => null,
                'url'    => '/promotions/1',
            ],
            [
                'title'  => 'Скидки до 35% на средства от клещей, блох и гельминтов',
                'period' => 'c 1 мая по 31 мая',
                'image'  => null,
                'url'    => '/promotions/2',
            ],
            [
                'title'  => 'Ownat: -15% на сухой корм для кошек и собак',
                'period' => 'c 1 мая по 31 мая',
                'image'  => null,
                'url'    => '/promotions/3',
            ],
        ];

        return view('site.home', compact('products', 'promotions'));
    }
}
