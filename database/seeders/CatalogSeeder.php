<?php

namespace Database\Seeders;

use App\Models\AnimalType;
use App\Models\Article;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\Review;
use Illuminate\Database\Seeder;

class CatalogSeeder extends Seeder
{
    public function run(): void
    {
        $categories = collect([
            ['name' => 'Корм', 'slug' => 'korm', 'sort' => 10],
            ['name' => 'Игрушки', 'slug' => 'igrushki', 'sort' => 20],
            ['name' => 'Аксессуары', 'slug' => 'aksessuary', 'sort' => 30],
            ['name' => 'Уход', 'slug' => 'uhod', 'sort' => 40],
        ])->mapWithKeys(fn (array $data) => [
            $data['slug'] => Category::query()->updateOrCreate(['slug' => $data['slug']], $data),
        ]);

        $brands = collect([
            ['name' => 'Dai Lapu Care', 'slug' => 'dai-lapu-care'],
            ['name' => 'Happy Paw', 'slug' => 'happy-paw'],
            ['name' => 'Pet Garden', 'slug' => 'pet-garden'],
        ])->mapWithKeys(fn (array $data) => [
            $data['slug'] => Brand::query()->updateOrCreate(['slug' => $data['slug']], $data),
        ]);

        $animalTypes = collect([
            ['name' => 'Кошки', 'slug' => 'cats'],
            ['name' => 'Собаки', 'slug' => 'dogs'],
            ['name' => 'Грызуны', 'slug' => 'rodents'],
            ['name' => 'Птицы', 'slug' => 'birds'],
        ])->mapWithKeys(fn (array $data) => [
            $data['slug'] => AnimalType::query()->updateOrCreate(['slug' => $data['slug']], $data),
        ]);

        collect([
            ['name' => 'Сухой корм для кошек с индейкой', 'slug' => 'suhoi-korm-dlya-koshek-s-indeikoi', 'category' => 'korm', 'brand' => 'dai-lapu-care', 'animal' => 'cats', 'price' => 890, 'old_price' => 1090, 'stock' => 24, 'age_group' => 'Взрослые', 'is_hit' => true],
            ['name' => 'Влажный корм для собак с говядиной', 'slug' => 'vlazhnyi-korm-dlya-sobak-s-govyadinoi', 'category' => 'korm', 'brand' => 'happy-paw', 'animal' => 'dogs', 'price' => 180, 'stock' => 80, 'age_group' => 'Взрослые', 'is_new' => true],
            ['name' => 'Мячик с пищалкой', 'slug' => 'myachik-s-pischalkoi', 'category' => 'igrushki', 'brand' => 'pet-garden', 'animal' => 'dogs', 'price' => 320, 'stock' => 34, 'is_hit' => true],
            ['name' => 'Удочка-дразнилка для кошек', 'slug' => 'udochka-draznilka-dlya-koshek', 'category' => 'igrushki', 'brand' => 'happy-paw', 'animal' => 'cats', 'price' => 260, 'stock' => 45, 'is_new' => true],
            ['name' => 'Лежанка мягкая круглая', 'slug' => 'lezhanka-myagkaya-kruglaya', 'category' => 'aksessuary', 'brand' => 'dai-lapu-care', 'animal' => 'cats', 'price' => 1590, 'old_price' => 1890, 'stock' => 11, 'is_hit' => true],
            ['name' => 'Шампунь для чувствительной кожи', 'slug' => 'shampun-dlya-chuvstvitelnoi-kozhi', 'category' => 'uhod', 'brand' => 'pet-garden', 'animal' => 'dogs', 'price' => 520, 'stock' => 19],
            ['name' => 'Минеральный камень для грызунов', 'slug' => 'mineralnyi-kamen-dlya-gryzunov', 'category' => 'uhod', 'brand' => 'happy-paw', 'animal' => 'rodents', 'price' => 140, 'stock' => 37],
            ['name' => 'Корм для волнистых попугаев', 'slug' => 'korm-dlya-volnistyh-popugaev', 'category' => 'korm', 'brand' => 'pet-garden', 'animal' => 'birds', 'price' => 230, 'stock' => 28, 'is_new' => true],
        ])->each(function (array $data) use ($categories, $brands, $animalTypes): void {
            Product::query()->updateOrCreate(
                ['slug' => $data['slug']],
                [
                    'category_id' => $categories[$data['category']]->id,
                    'brand_id' => $brands[$data['brand']]->id,
                    'animal_type_id' => $animalTypes[$data['animal']]->id,
                    'name' => $data['name'],
                    'description' => 'Товар подобран для ежедневной заботы о питомце. Подходит для регулярного использования и представлен в наличии в магазине.',
                    'price' => $data['price'],
                    'old_price' => $data['old_price'] ?? null,
                    'stock' => $data['stock'],
                    'age_group' => $data['age_group'] ?? null,
                    'is_hit' => $data['is_hit'] ?? false,
                    'is_new' => $data['is_new'] ?? false,
                    'published' => true,
                ],
            );
        });

        Article::query()->updateOrCreate(
            ['slug' => 'kak-vybrat-korm-dlya-pitomca'],
            [
                'title' => 'Как выбрать корм для питомца',
                'excerpt' => 'Короткая памятка по возрасту, составу и режиму питания.',
                'body' => "Выбирайте корм с учётом возраста, активности и особенностей здоровья питомца.\n\nПереход на новый корм лучше делать постепенно: смешивайте его со старым в течение нескольких дней.",
                'published_at' => now()->subDay(),
            ],
        );

        Promotion::query()->updateOrCreate(
            ['slug' => 'skidka-na-uhod'],
            [
                'title' => 'Скидки на средства ухода',
                'description' => 'Выгодные предложения на шампуни, расчёски и средства гигиены для питомцев.',
                'starts_at' => now()->toDateString(),
                'ends_at' => now()->addMonth()->toDateString(),
                'published' => true,
            ],
        );

        $product = Product::query()->first();
        if ($product) {
            Review::query()->updateOrCreate(
                ['email' => 'client@example.com', 'product_id' => $product->id],
                [
                    'name' => 'Мария',
                    'rating' => 5,
                    'body' => 'Быстро помогли подобрать товар, питомцу всё подошло.',
                    'approved' => true,
                ],
            );
        }
    }
}
