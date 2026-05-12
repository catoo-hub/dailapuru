<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\StoresUploadedImages;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Support\Slugs;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BrandController extends Controller
{
    use StoresUploadedImages;

    public function index(): View
    {
        return view('admin.brands.index', [
            'brands' => Brand::query()->withCount('products')->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['slug'] = ($data['slug'] ?? null) ?: Slugs::unique(Brand::class, $data['name']);
        $data['logo'] = $this->imagePath($request, 'logo_file', 'logo', 'brands');

        Brand::query()->create($data);

        return back()->with('status', 'Бренд создан.');
    }

    public function update(Request $request, Brand $brand): RedirectResponse
    {
        $data = $this->validated($request, $brand);
        $data['slug'] = ($data['slug'] ?? null) ?: Slugs::unique(Brand::class, $data['name'], $brand->id);
        $data['logo'] = $this->imagePath($request, 'logo_file', 'logo', 'brands', $brand->logo);

        $brand->update($data);

        return back()->with('status', 'Бренд обновлён.');
    }

    public function destroy(Brand $brand): RedirectResponse
    {
        $brand->delete();

        return back()->with('status', 'Бренд удалён.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request, ?Brand $brand = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:brands,slug,'.($brand?->id ?? 'NULL')],
            'logo' => ['nullable', 'string', 'max:255'],
            'logo_file' => ['nullable', 'image', 'max:4096'],
        ]);
    }
}
