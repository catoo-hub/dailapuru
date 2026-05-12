<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        return view('admin.users.index', [
            'users' => User::query()
                ->latest()
                ->paginate(15),
        ]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'phone' => ['nullable', 'string', 'max:32'],
            'is_admin' => ['nullable', 'boolean'],
        ]);

        if ($request->user()->is($user) && ! (bool) ($data['is_admin'] ?? false)) {
            return back()->withErrors(['user' => 'Нельзя снять права администратора со своего аккаунта.']);
        }

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'is_admin' => (bool) ($data['is_admin'] ?? false),
        ]);

        return back()->with('status', 'Пользователь обновлён.');
    }

    public function toggleBlock(Request $request, User $user): RedirectResponse
    {
        if ($request->user()->is($user)) {
            return back()->withErrors(['user' => 'Нельзя заблокировать свой аккаунт.']);
        }

        $user->update([
            'blocked_at' => $user->blocked_at ? null : now(),
        ]);

        return back()->with('status', $user->blocked_at ? 'Пользователь заблокирован.' : 'Пользователь разблокирован.');
    }
}
