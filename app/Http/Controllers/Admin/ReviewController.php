<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReviewController extends Controller
{
    public function index(Request $request): View
    {
        $reviews = Review::query()
            ->with(['product', 'user'])
            ->when($request->string('status')->toString() === 'approved', fn ($query) => $query->where('approved', true))
            ->when($request->string('status')->toString() === 'pending', fn ($query) => $query->where('approved', false))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.reviews.index', [
            'reviews' => $reviews,
        ]);
    }

    public function approve(Review $review): RedirectResponse
    {
        $review->update(['approved' => true]);

        return back()->with('status', 'Отзыв опубликован.');
    }

    public function reject(Review $review): RedirectResponse
    {
        $review->update(['approved' => false]);

        return back()->with('status', 'Отзыв снят с публикации.');
    }

    public function destroy(Review $review): RedirectResponse
    {
        $review->delete();

        return back()->with('status', 'Отзыв удалён.');
    }
}
