<?php

use App\Http\Controllers\Admin\AnimalTypeController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\PromocodeController;
use App\Http\Controllers\Admin\PromotionController as AdminPromotionController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Site\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('guest')->group(function (): void {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');

    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
});

Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::middleware(['auth', 'not_blocked'])->group(function (): void {
    Route::get('/account', [ProfileController::class, 'dashboard'])->name('account.dashboard');
    Route::put('/account/profile', [ProfileController::class, 'update'])->name('account.profile.update');
    Route::put('/account/password', [ProfileController::class, 'password'])->name('account.password.update');

    Route::prefix('admin')
        ->name('admin.')
        ->middleware('admin')
        ->group(function (): void {
            Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

            Route::resource('products', AdminProductController::class)->except('show');
            Route::resource('categories', CategoryController::class)->except(['show', 'create', 'edit']);
            Route::resource('brands', BrandController::class)->except(['show', 'create', 'edit']);
            Route::resource('animal-types', AnimalTypeController::class)
                ->parameters(['animal-types' => 'animalType'])
                ->except(['show', 'create', 'edit']);
            Route::resource('articles', AdminArticleController::class)->except('show');
            Route::resource('promotions', AdminPromotionController::class)->except('show');
            Route::resource('promocodes', PromocodeController::class)->except(['show', 'create', 'edit']);
            Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
            Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
            Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
            Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
            Route::get('/reviews', [AdminReviewController::class, 'index'])->name('reviews.index');
            Route::post('/reviews/{review}/approve', [AdminReviewController::class, 'approve'])->name('reviews.approve');
            Route::post('/reviews/{review}/reject', [AdminReviewController::class, 'reject'])->name('reviews.reject');
            Route::delete('/reviews/{review}', [AdminReviewController::class, 'destroy'])->name('reviews.destroy');

            Route::get('/users', [UserController::class, 'index'])->name('users.index');
            Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
            Route::post('/users/{user}/block', [UserController::class, 'toggleBlock'])->name('users.block');

            Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
            Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
        });
});
