<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::updateValues([
            'shop_phone' => '+7 900 000-00-00',
            'shop_email' => 'hello@dailapu.test',
            'shop_address' => 'г. Самара, ул. Лапкина, 12',
            'shop_working_hours' => 'Ежедневно с 10:00 до 20:00',
            'call_phone' => '+79000000000',
        ]);
    }
}
