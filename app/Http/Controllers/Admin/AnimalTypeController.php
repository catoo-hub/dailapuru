<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnimalType;
use App\Support\Slugs;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AnimalTypeController extends Controller
{
    public function index(): View
    {
        return view('admin.animal-types.index', [
            'animalTypes' => AnimalType::query()->withCount('products')->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['slug'] = ($data['slug'] ?? null) ?: Slugs::unique(AnimalType::class, $data['name']);

        AnimalType::query()->create($data);

        return back()->with('status', 'Вид животного создан.');
    }

    public function update(Request $request, AnimalType $animalType): RedirectResponse
    {
        $data = $this->validated($request, $animalType);
        $data['slug'] = ($data['slug'] ?? null) ?: Slugs::unique(AnimalType::class, $data['name'], $animalType->id);

        $animalType->update($data);

        return back()->with('status', 'Вид животного обновлён.');
    }

    public function destroy(AnimalType $animalType): RedirectResponse
    {
        $animalType->delete();

        return back()->with('status', 'Вид животного удалён.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request, ?AnimalType $animalType = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:animal_types,slug,'.($animalType?->id ?? 'NULL')],
        ]);
    }
}
