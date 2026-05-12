<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\StoresUploadedImages;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Support\Slugs;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    use StoresUploadedImages;

    public function index(): View
    {
        return view('admin.categories.index', [
            'categories' => Category::query()->withCount('products')->with('parent')->orderBy('sort')->orderBy('name')->get(),
            'parents' => Category::query()->orderBy('sort')->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['slug'] = ($data['slug'] ?? null) ?: Slugs::unique(Category::class, $data['name']);
        $data['image'] = $this->imagePath($request, 'image_file', 'image', 'categories');

        Category::query()->create($data);

        return back()->with('status', 'Категория создана.');
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $data = $this->validated($request, $category);
        $data['slug'] = ($data['slug'] ?? null) ?: Slugs::unique(Category::class, $data['name'], $category->id);
        $data['image'] = $this->imagePath($request, 'image_file', 'image', 'categories', $category->image);

        if ((int) ($data['parent_id'] ?? 0) === $category->id) {
            return back()->withErrors(['parent_id' => 'Категория не может быть родителем самой себя.']);
        }

        $category->update($data);

        return back()->with('status', 'Категория обновлена.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return back()->with('status', 'Категория удалена.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request, ?Category $category = null): array
    {
        return $request->validate([
            'parent_id' => ['nullable', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:categories,slug,'.($category?->id ?? 'NULL')],
            'image' => ['nullable', 'string', 'max:255'],
            'image_file' => ['nullable', 'image', 'max:4096'],
            'sort' => ['nullable', 'integer', 'min:0'],
        ]);
    }
}
