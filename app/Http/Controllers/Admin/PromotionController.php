<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\StoresUploadedImages;
use App\Http\Controllers\Controller;
use App\Models\Promotion;
use App\Support\Slugs;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PromotionController extends Controller
{
    use StoresUploadedImages;

    public function index(): View
    {
        return view('admin.promotions.index', [
            'promotions' => Promotion::query()->latest()->paginate(15),
        ]);
    }

    public function create(): View
    {
        return view('admin.promotions.form', [
            'promotion' => new Promotion(['published' => true, 'starts_at' => now()]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['slug'] = ($data['slug'] ?? null) ?: Slugs::unique(Promotion::class, $data['title']);
        $data['image'] = $this->imagePath($request, 'image_file', 'image', 'promotions');
        $data['published'] = (bool) ($data['published'] ?? false);

        Promotion::query()->create($data);

        return redirect()->route('admin.promotions.index')->with('status', 'Акция создана.');
    }

    public function edit(Promotion $promotion): View
    {
        return view('admin.promotions.form', [
            'promotion' => $promotion,
        ]);
    }

    public function update(Request $request, Promotion $promotion): RedirectResponse
    {
        $data = $this->validated($request, $promotion);
        $data['slug'] = ($data['slug'] ?? null) ?: Slugs::unique(Promotion::class, $data['title'], $promotion->id);
        $data['image'] = $this->imagePath($request, 'image_file', 'image', 'promotions', $promotion->image);
        $data['published'] = (bool) ($data['published'] ?? false);

        $promotion->update($data);

        return redirect()->route('admin.promotions.index')->with('status', 'Акция обновлена.');
    }

    public function destroy(Promotion $promotion): RedirectResponse
    {
        $promotion->delete();

        return back()->with('status', 'Акция удалена.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request, ?Promotion $promotion = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:promotions,slug,'.($promotion?->id ?? 'NULL')],
            'image' => ['nullable', 'string', 'max:255'],
            'image_file' => ['nullable', 'image', 'max:4096'],
            'description' => ['nullable', 'string'],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
            'published' => ['nullable', 'boolean'],
        ]);
    }
}
