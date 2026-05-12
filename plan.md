# Структура проекта "Дай Лапу"

## 1. База данных (`database/migrations/`)

| Миграция                      | Назначение                                                                                                                               |
| ----------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------- |
| `create_categories_table`     | id, parent_id (иерархия), name, slug, image, sort                                                                                        |
| `create_brands_table`         | id, name, slug, logo                                                                                                                     |
| `create_animal_types_table`   | id, name, slug (кошки, собаки, грызуны, птицы…)                                                                                          |
| `create_products_table`       | id, category_id, brand_id, animal_type_id, name, slug, description, price, old_price, stock, age_group, is_hit, is_new, views, published |
| `create_product_images_table` | id, product_id, path, sort                                                                                                               |
| `create_users_table` (правка) | + phone, social_id, social_provider, blocked_at                                                                                          |
| `create_addresses_table`      | id, user_id, city, street, house, apt, zip, is_default                                                                                   |
| `create_orders_table`         | id, user_id, status (new/processing/shipped/done/cancelled), total, promo_id, address snapshot                                           |
| `create_order_items_table`    | id, order_id, product_id, qty, price                                                                                                     |
| `create_favorites_table`      | user_id, product_id                                                                                                                      |
| `create_articles_table`       | id, title, slug, excerpt, body, cover, published_at                                                                                      |
| `create_promotions_table`     | id, title, image, description, starts_at, ends_at                                                                                        |
| `create_promocodes_table`     | id, code, discount_percent, valid_until, usage_limit                                                                                     |
| `create_reviews_table`        | id, user_id, product_id (nullable — отзыв о магазине), rating, body, approved                                                            |
| `create_settings_table`       | key, value (телефон «Позвонить», email, адрес, график, соц-сети)                                                                         |

## 2. Модели (`app/Models/`)

```
Category.php  Brand.php  AnimalType.php
Product.php   ProductImage.php
Order.php     OrderItem.php   Address.php
Article.php   Promotion.php   Promocode.php
Review.php    Favorite.php    Setting.php
User.php (расширить)
```

## 3. Контроллеры (`app/Http/Controllers/`)

```
Site/
  HomeController.php          // главная: хиты, новинки, баннер «Котолог»
  CatalogController.php       // index с фильтрами/сортировкой, show
  CartController.php          // index, add, update, remove, applyPromo
  CheckoutController.php
  FavoriteController.php
  SearchController.php        // + autocomplete (JSON)
  ArticleController.php
  PromotionController.php
  ReviewController.php
  AboutController.php
  ContactController.php

Auth/                          // Laravel breeze-style: Login, Register, Password*, Socialite
  LoginController.php
  RegisterController.php
  SocialAuthController.php
  ProfileController.php
  OrderHistoryController.php
  AddressController.php

Admin/
  DashboardController.php
  ProductController.php
  CategoryController.php
  BrandController.php
  OrderController.php
  ArticleController.php
  PromotionController.php
  PromocodeController.php
  ReviewController.php
  UserController.php
  SettingController.php
  ReportController.php
```

Form Requests — `app/Http/Requests/{Product,Order,Review,Checkout}Request.php`.
Middleware — `EnsureUserIsAdmin`, `EnsureUserNotBlocked`.
Policies — `ProductPolicy`, `OrderPolicy`, `ReviewPolicy`.

## 4. Сервисы / Actions (`app/Services/`, `app/Actions/`)

```
Cart/CartService.php          // сессия + БД для авторизованных
Cart/PromocodeApplier.php
Catalog/ProductFilter.php     // фильтрация по категории/виду/бренду/цене/возрасту, сортировки
Checkout/PlaceOrderAction.php
Report/SalesReport.php
```

## 5. Маршруты (`routes/web.php`)

```
/                     home
/catalog              + /catalog/{categorySlug?}
/product/{slug}
/cart, /checkout
/favorites
/articles, /articles/{slug}
/promotions, /promotions/{id}
/reviews
/about, /contacts
/search/autocomplete
/login, /register, /auth/{provider}/redirect|callback
/account, /account/orders, /account/addresses

/admin/*              группа с middleware admin
```

## 6. Blade-шаблоны (`resources/views/`)

```
layouts/
  app.blade.php                 // base: <head>, шапка, футер, плавающая «Позвонить»
  admin.blade.php

components/                     // anonymous Blade components — <x-...>
  header.blade.php              // лого «Дай Лапу», меню, корзина, иконка профиля
  footer.blade.php
  call-button.blade.php         // плавающая «Позвонить», номер из settings
  search-bar.blade.php          // с autocomplete
  product-card.blade.php        // розовая карточка как на макете
  product-grid.blade.php        // bento-сетка (крупные + мелкие плитки)
  category-filter.blade.php
  filter-dropdown.blade.php     // Бренды / Типы / Вид животного
  sort-tabs.blade.php           // Все / Популярные / Новые
  price-range.blade.php
  pagination.blade.php
  promo-slider.blade.php        // «Акции» с -30/-35/-15 карточками
  promo-card.blade.php
  article-card.blade.php
  review-card.blade.php
  rating-stars.blade.php
  breadcrumbs.blade.php
  hero.blade.php                // синий блок с «КОТОЛОГ» + иллюстрация
  empty-state.blade.php
  modals/login.blade.php
  modals/quick-view.blade.php

site/
  home.blade.php
  catalog/index.blade.php
  catalog/show.blade.php        // карточка товара
  cart/index.blade.php
  checkout/index.blade.php
  favorites/index.blade.php
  articles/{index,show}.blade.php
  promotions/{index,show}.blade.php
  reviews/index.blade.php
  about.blade.php
  contacts.blade.php

auth/                            // login, register, forgot, reset, social-link
account/                         // profile, orders, order-show, addresses

admin/
  dashboard.blade.php
  products/{index,form}.blade.php
  categories/{index,form}.blade.php
  brands/...
  orders/{index,show}.blade.php
  articles/...
  promotions/...
  promocodes/...
  reviews/index.blade.php
  users/index.blade.php
  settings.blade.php
  reports.blade.php
  components/sidebar.blade.php
  components/data-table.blade.php
  components/form-field.blade.php
```

## 7. Фронтенд (`resources/`)

```
css/
  app.css                  // Tailwind v4 entry + @theme токены
  themes.css               // цвета бренда: blue-500 фон, pink-300 карточки, акцент жёлтый

js/
  app.js                   // bootstrap
  modules/
    cart.js                // add/remove, обновление шапки
    favorites.js
    search-autocomplete.js
    filters.js             // dropdown, sort, price-range
    promo-slider.js        // стрелки ‹ ›
    call-button.js         // tel: на мобильных
    quick-view.js
    admin/table-actions.js
    admin/image-uploader.js

images/
  logo-dailapu.svg
  hero-cat.png             // котолог-иллюстрация
  placeholders/
```

## 8. SEO / производительность

- `app/View/Composers/MetaComposer.php` + `<x-meta>` компонент (Title, Description).
- `routes/web.php` — slug-маршруты, человекочитаемые URL.
- `config/sitemap.php` + команда `php artisan sitemap:generate` (`app/Console/Commands/GenerateSitemap.php`) → `public/sitemap.xml`.
- `public/robots.txt`.
- JSON-LD микроразметка в `components/schema/product.blade.php`, `schema/review.blade.php`.
- Изображения через `intervention/image` + `loading="lazy"`, WebP-конверсия в `App\Services\Media\ImageOptimizer`.

## 9. Безопасность

- Стандартный Laravel auth + Socialite (`config/services.php`).
- CSRF — везде (Blade `@csrf`), XSS — `{{ }}`, SQL — только Eloquent/Query Builder.
- `EnsureUserIsAdmin` middleware + Gate `admin`.
- Rate-limit на login, search, review-submit (`RouteServiceProvider`).

## 10. Сидеры / фабрики

```
database/seeders/
  DatabaseSeeder.php
  CategorySeeder.php  BrandSeeder.php  AnimalTypeSeeder.php
  ProductSeeder.php   PromotionSeeder.php  ArticleSeeder.php
  AdminUserSeeder.php SettingSeeder.php
database/factories/
  ProductFactory.php  OrderFactory.php  ArticleFactory.php  ReviewFactory.php
```
