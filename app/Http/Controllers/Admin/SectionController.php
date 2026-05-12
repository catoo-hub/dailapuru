<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class SectionController extends Controller
{
    public function show(string $section): View
    {
        abort_unless(array_key_exists($section, $this->sections()), 404);

        return view('admin.sections.show', [
            'section' => $section,
            'meta' => $this->sections()[$section],
        ]);
    }

    /**
     * @return array<string, array{title: string, description: string, tasks: list<string>}>
     */
    private function sections(): array
    {
        return [
            'products' => [
                'title' => 'Товары',
                'description' => 'Добавление, редактирование, остатки, цены, изображения и публикация товаров.',
                'tasks' => ['Категории и бренды', 'Цены и остатки', 'Галерея товара', 'Хиты и новинки'],
            ],
            'categories' => [
                'title' => 'Категории',
                'description' => 'Иерархия каталога: корм, игрушки, аксессуары, уход и подкатегории.',
                'tasks' => ['Дерево категорий', 'Сортировка', 'SEO slug', 'Изображение категории'],
            ],
            'orders' => [
                'title' => 'Заказы',
                'description' => 'Просмотр заказов, обработка и смена статусов.',
                'tasks' => ['Новый', 'В обработке', 'Отправлен', 'Выполнен', 'Отменён'],
            ],
            'articles' => [
                'title' => 'Статьи',
                'description' => 'Полезные материалы о выборе корма, уходе и товарах.',
                'tasks' => ['Черновики', 'Публикация', 'Обложки', 'Мета-теги'],
            ],
            'promotions' => [
                'title' => 'Акции',
                'description' => 'Скидочные предложения, сроки действия и промо-баннеры.',
                'tasks' => ['Период акции', 'Изображение', 'Описание', 'Публикация'],
            ],
            'reviews' => [
                'title' => 'Отзывы',
                'description' => 'Модерация отзывов о товарах и магазине.',
                'tasks' => ['Ожидают проверки', 'Подтверждены', 'Отклонены', 'Рейтинг'],
            ],
            'reports' => [
                'title' => 'Отчёты',
                'description' => 'Продажи по периодам, популярные товары и активность покупателей.',
                'tasks' => ['Продажи', 'Популярные товары', 'Активность', 'Конверсия'],
            ],
        ];
    }
}
