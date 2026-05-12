<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(): View
    {
        $ordersByStatus = Order::query()
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        $popularProducts = OrderItem::query()
            ->select('product_name', DB::raw('sum(qty) as qty'), DB::raw('sum(qty * price) as revenue'))
            ->groupBy('product_name')
            ->orderByDesc('qty')
            ->limit(10)
            ->get();

        $salesByDay = Order::query()
            ->select(DB::raw('date(created_at) as day'), DB::raw('sum(total) as revenue'), DB::raw('count(*) as orders_count'))
            ->whereIn('status', ['processing', 'shipped', 'done'])
            ->where('created_at', '>=', now()->subDays(14))
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        return view('admin.reports.index', [
            'summary' => [
                'orders' => Order::query()->count(),
                'revenue' => Order::query()->whereIn('status', ['processing', 'shipped', 'done'])->sum('total'),
                'products' => Product::query()->count(),
                'users' => User::query()->count(),
                'pending_reviews' => Review::query()->where('approved', false)->count(),
            ],
            'ordersByStatus' => $ordersByStatus,
            'popularProducts' => $popularProducts,
            'salesByDay' => $salesByDay,
            'statuses' => Order::STATUSES,
        ]);
    }
}
