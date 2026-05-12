<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function edit(): View
    {
        return view('admin.settings.edit', [
            'settings' => Setting::query()->pluck('value', 'key'),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'shop_phone' => ['nullable', 'string', 'max:64'],
            'shop_email' => ['nullable', 'email', 'max:255'],
            'shop_address' => ['nullable', 'string', 'max:255'],
            'shop_working_hours' => ['nullable', 'string', 'max:255'],
            'call_phone' => ['nullable', 'string', 'max:64'],
        ]);

        Setting::updateValues($data);

        return back()->with('status', 'Настройки сохранены.');
    }
}
