<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Order;
use App\Models\Product;
use App\Models\Promocode;
use App\Models\Promotion;
use App\Models\Review;
use App\Models\Setting;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'stats' => [
                'users' => User::query()->count(),
                'products' => Product::query()->count(),
                'articles' => Article::query()->count(),
                'promotions' => Promotion::query()->count(),
                'orders' => Order::query()->count(),
                'revenue' => Order::query()->whereIn('status', ['processing', 'shipped', 'done'])->sum('total'),
                'promocodes' => Promocode::query()->count(),
                'pending_reviews' => Review::query()->where('approved', false)->count(),
                'settings' => Setting::query()->count(),
            ],
        ]);
    }
}
