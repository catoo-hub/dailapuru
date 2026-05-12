<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promocode;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PromocodeController extends Controller
{
    public function index(): View
    {
        return view('admin.promocodes.index', [
            'promocodes' => Promocode::query()->withCount('orders')->latest()->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['code'] = mb_strtoupper($data['code']);
        $data['active'] = (bool) ($data['active'] ?? false);

        Promocode::query()->create($data);

        return back()->with('status', 'Промокод создан.');
    }

    public function update(Request $request, Promocode $promocode): RedirectResponse
    {
        $data = $this->validated($request, $promocode);
        $data['code'] = mb_strtoupper($data['code']);
        $data['active'] = (bool) ($data['active'] ?? false);

        $promocode->update($data);

        return back()->with('status', 'Промокод обновлён.');
    }

    public function destroy(Promocode $promocode): RedirectResponse
    {
        $promocode->delete();

        return back()->with('status', 'Промокод удалён.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request, ?Promocode $promocode = null): array
    {
        return $request->validate([
            'code' => [
                'required',
                'string',
                'max:64',
                Rule::unique('promocodes', 'code')->ignore($promocode),
            ],
            'discount_percent' => ['required', 'integer', 'min:1', 'max:90'],
            'valid_until' => ['nullable', 'date'],
            'usage_limit' => ['nullable', 'integer', 'min:1'],
            'used_count' => ['nullable', 'integer', 'min:0'],
            'active' => ['nullable', 'boolean'],
        ]);
    }
}
