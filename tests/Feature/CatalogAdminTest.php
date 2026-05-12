<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CatalogAdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_product(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $category = Category::query()->create([
            'name' => 'Корм',
            'slug' => 'korm',
        ]);

        $this->actingAs($admin)
            ->post(route('admin.products.store'), [
                'category_id' => $category->id,
                'name' => 'Тестовый корм',
                'price' => 500,
                'stock' => 7,
                'published' => 1,
            ])
            ->assertRedirect(route('admin.products.index'));

        $this->assertDatabaseHas('products', [
            'name' => 'Тестовый корм',
            'price' => 500,
            'stock' => 7,
            'published' => true,
        ]);
    }

    public function test_admin_can_open_catalog_management_pages(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);

        foreach ([
            route('admin.products.index'),
            route('admin.categories.index'),
            route('admin.brands.index'),
            route('admin.animal-types.index'),
            route('admin.articles.index'),
            route('admin.promotions.index'),
            route('admin.promocodes.index'),
            route('admin.orders.index'),
            route('admin.reports.index'),
            route('admin.reviews.index'),
        ] as $url) {
            $this->actingAs($admin)->get($url)->assertOk();
        }
    }

    public function test_admin_can_update_order_status(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $order = Order::query()->create([
            'status' => 'new',
            'customer_name' => 'Мария',
            'total' => 1000,
        ]);

        $this->actingAs($admin)
            ->put(route('admin.orders.update', $order), [
                'status' => 'done',
                'comment' => 'Заказ выполнен.',
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => 'done',
            'comment' => 'Заказ выполнен.',
        ]);
    }
}
