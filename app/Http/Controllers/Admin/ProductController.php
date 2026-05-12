<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\StoresUploadedImages;
use App\Http\Controllers\Controller;
use App\Models\AnimalType;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Support\Slugs;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    use StoresUploadedImages;

    public function index(Request $request): View
    {
        $products = Product::query()
            ->with(['category', 'brand', 'animalType'])
            ->when($request->filled('q'), function ($query) use ($request): void {
                $query->where('name', 'like', '%'.$request->string('q')->toString().'%');
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.products.index', [
            'products' => $products,
            'categories' => $this->categories(),
            'brands' => Brand::query()->orderBy('name')->get(),
            'animalTypes' => AnimalType::query()->orderBy('name')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.products.form', [
            'product' => new Product(['published' => true, 'is_new' => true, 'stock' => 0, 'price' => 0]),
            'categories' => $this->categories(),
            'brands' => Brand::query()->orderBy('name')->get(),
            'animalTypes' => AnimalType::query()->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['slug'] = ($data['slug'] ?? null) ?: Slugs::unique(Product::class, $data['name']);
        $data['image'] = $this->imagePath($request, 'image_file', 'image', 'products');
        $data = $this->withBooleans($data);

        Product::query()->create($data);

        return redirect()->route('admin.products.index')->with('status', 'Товар создан.');
    }

    public function edit(Product $product): View
    {
        return view('admin.products.form', [
            'product' => $product,
            'categories' => $this->categories(),
            'brands' => Brand::query()->orderBy('name')->get(),
            'animalTypes' => AnimalType::query()->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $data = $this->validated($request, $product);
        $data['slug'] = ($data['slug'] ?? null) ?: Slugs::unique(Product::class, $data['name'], $product->id);
        $data['image'] = $this->imagePath($request, 'image_file', 'image', 'products', $product->image);
        $data = $this->withBooleans($data);

        $product->update($data);

        return redirect()->route('admin.products.index')->with('status', 'Товар обновлён.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return back()->with('status', 'Товар удалён.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request, ?Product $product = null): array
    {
        return $request->validate([
            'category_id' => ['nullable', 'exists:categories,id'],
            'brand_id' => ['nullable', 'exists:brands,id'],
            'animal_type_id' => ['nullable', 'exists:animal_types,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:products,slug,'.($product?->id ?? 'NULL')],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'string', 'max:255'],
            'image_file' => ['nullable', 'image', 'max:4096'],
            'price' => ['required', 'numeric', 'min:0'],
            'old_price' => ['nullable', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'age_group' => ['nullable', 'string', 'max:255'],
            'is_hit' => ['nullable', 'boolean'],
            'is_new' => ['nullable', 'boolean'],
            'published' => ['nullable', 'boolean'],
        ]);
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    private function withBooleans(array $data): array
    {
        $data['is_hit'] = (bool) ($data['is_hit'] ?? false);
        $data['is_new'] = (bool) ($data['is_new'] ?? false);
        $data['published'] = (bool) ($data['published'] ?? false);

        return $data;
    }

    private function categories()
    {
        return Category::query()->with('parent')->orderBy('sort')->orderBy('name')->get();
    }
}
