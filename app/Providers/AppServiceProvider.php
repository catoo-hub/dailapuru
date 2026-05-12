<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Throwable;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view): void {
            $defaults = collect([
                'shop_phone' => '+7 900 000-00-00',
                'shop_email' => 'hello@dailapu.test',
                'shop_address' => 'г. Самара, ул. Лапкина, 12',
                'shop_working_hours' => 'Ежедневно с 10:00 до 20:00',
                'call_phone' => '+79000000000',
            ]);

            try {
                $settings = Schema::hasTable('settings')
                    ? Setting::query()->pluck('value', 'key')
                    : collect();
            } catch (Throwable) {
                $settings = collect();
            }

            $view->with('siteSettings', $defaults->merge($settings));
        });
    }
}
