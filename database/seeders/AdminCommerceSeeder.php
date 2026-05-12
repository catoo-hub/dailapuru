<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Models\Promocode;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminCommerceSeeder extends Seeder
{
    public function run(): void
    {
        $promocode = Promocode::query()->updateOrCreate(
            ['code' => 'LAPU10'],
            [
                'discount_percent' => 10,
                'valid_until' => now()->addMonth()->toDateString(),
                'usage_limit' => 100,
                'used_count' => 1,
                'active' => true,
            ],
        );

        $user = User::query()->where('email', 'test@example.com')->first();
        $products = Product::query()->take(2)->get();

        if ($products->isEmpty()) {
            return;
        }

        $order = Order::query()->updateOrCreate(
            ['customer_email' => 'client@example.com', 'customer_phone' => '+7 900 222-33-44'],
            [
                'user_id' => $user?->id,
                'promocode_id' => $promocode->id,
                'status' => 'processing',
                'customer_name' => 'Мария Иванова',
                'address_snapshot' => 'г. Самара, ул. Лапкина, 12, кв. 8',
                'total' => $products->sum(fn (Product $product) => (float) $product->price),
                'comment' => 'Демо-заказ для проверки админки.',
            ],
        );

        $order->items()->delete();

        foreach ($products as $product) {
            $order->items()->create([
                'product_id' => $product->id,
                'product_name' => $product->name,
                'qty' => 1,
                'price' => $product->price,
            ]);
        }
    }
}
