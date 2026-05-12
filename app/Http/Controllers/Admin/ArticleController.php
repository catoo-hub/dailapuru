<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\StoresUploadedImages;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Support\Slugs;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends Controller
{
    use StoresUploadedImages;

    public function index(): View
    {
        return view('admin.articles.index', [
            'articles' => Article::query()->latest()->paginate(15),
        ]);
    }

    public function create(): View
    {
        return view('admin.articles.form', [
            'article' => new Article(['published_at' => now()]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['slug'] = ($data['slug'] ?? null) ?: Slugs::unique(Article::class, $data['title']);
        $data['cover'] = $this->imagePath($request, 'cover_file', 'cover', 'articles');
        $data['published_at'] = $request->boolean('published') ? ($data['published_at'] ?? now()) : null;

        Article::query()->create($data);

        return redirect()->route('admin.articles.index')->with('status', 'Статья создана.');
    }

    public function edit(Article $article): View
    {
        return view('admin.articles.form', [
            'article' => $article,
        ]);
    }

    public function update(Request $request, Article $article): RedirectResponse
    {
        $data = $this->validated($request, $article);
        $data['slug'] = ($data['slug'] ?? null) ?: Slugs::unique(Article::class, $data['title'], $article->id);
        $data['cover'] = $this->imagePath($request, 'cover_file', 'cover', 'articles', $article->cover);
        $data['published_at'] = $request->boolean('published') ? ($data['published_at'] ?? now()) : null;

        $article->update($data);

        return redirect()->route('admin.articles.index')->with('status', 'Статья обновлена.');
    }

    public function destroy(Article $article): RedirectResponse
    {
        $article->delete();

        return back()->with('status', 'Статья удалена.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request, ?Article $article = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:articles,slug,'.($article?->id ?? 'NULL')],
            'excerpt' => ['nullable', 'string', 'max:1000'],
            'body' => ['nullable', 'string'],
            'cover' => ['nullable', 'string', 'max:255'],
            'cover_file' => ['nullable', 'image', 'max:4096'],
            'published_at' => ['nullable', 'date'],
            'published' => ['nullable', 'boolean'],
        ]);
    }
}
