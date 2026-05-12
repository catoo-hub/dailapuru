@extends('layouts.admin')

@section('title', 'Пользователи — Админка')
@section('page_title', 'Пользователи')

@section('content')
    <section class="overflow-hidden rounded-lg bg-white shadow-sm">
        <div class="border-b border-slate-200 p-5">
            <h2 class="text-xl font-extrabold">Зарегистрированные пользователи</h2>
            <p class="mt-1 text-sm font-semibold text-slate-600">Редактирование контактов, выдача прав администратора и блокировка аккаунтов.</p>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                <thead class="bg-slate-50 text-xs font-extrabold uppercase tracking-[0.08em] text-slate-500">
                    <tr>
                        <th class="px-5 py-3">Имя</th>
                        <th class="px-5 py-3">Email</th>
                        <th class="px-5 py-3">Телефон</th>
                        <th class="px-5 py-3">Роль</th>
                        <th class="px-5 py-3">Статус</th>
                        <th class="px-5 py-3">Действия</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($users as $user)
                        <tr>
                            <td class="px-5 py-4">
                                <form id="user-{{ $user->id }}" method="POST" action="{{ route('admin.users.update', $user) }}">
                                    @csrf
                                    @method('PUT')
                                </form>
                                <input form="user-{{ $user->id }}" name="name" value="{{ old('name', $user->name) }}" required
                                       class="h-10 w-48 rounded-lg border border-slate-200 px-3 font-semibold outline-none focus:border-brand-blue">
                            </td>
                            <td class="px-5 py-4">
                                <input form="user-{{ $user->id }}" type="email" name="email" value="{{ old('email', $user->email) }}" required
                                       class="h-10 w-64 rounded-lg border border-slate-200 px-3 font-semibold outline-none focus:border-brand-blue">
                            </td>
                            <td class="px-5 py-4">
                                <input form="user-{{ $user->id }}" name="phone" value="{{ old('phone', $user->phone) }}"
                                       class="h-10 w-44 rounded-lg border border-slate-200 px-3 font-semibold outline-none focus:border-brand-blue">
                            </td>
                            <td class="px-5 py-4">
                                <input form="user-{{ $user->id }}" type="hidden" name="is_admin" value="0">
                                <label class="inline-flex items-center gap-2 font-bold">
                                    <input form="user-{{ $user->id }}" type="checkbox" name="is_admin" value="1" @checked($user->is_admin)
                                           class="h-5 w-5 rounded border-slate-300 text-brand-blue">
                                    Админ
                                </label>
                            </td>
                            <td class="px-5 py-4">
                                @if ($user->blocked_at)
                                    <span class="inline-flex rounded-chip bg-red-100 px-3 py-1 text-xs font-extrabold text-red-700">Заблокирован</span>
                                @else
                                    <span class="inline-flex rounded-chip bg-emerald-100 px-3 py-1 text-xs font-extrabold text-emerald-700">Активен</span>
                                @endif
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-2">
                                    <button form="user-{{ $user->id }}" type="submit"
                                            class="inline-flex h-10 items-center rounded-lg bg-brand-blue px-4 text-xs font-extrabold text-white transition hover:bg-brand-blue-dark">
                                        Сохранить
                                    </button>
                                    <form method="POST" action="{{ route('admin.users.block', $user) }}">
                                        @csrf
                                        <button type="submit"
                                                class="inline-flex h-10 items-center rounded-lg border border-slate-200 px-4 text-xs font-extrabold transition hover:bg-slate-50">
                                            {{ $user->blocked_at ? 'Разблокировать' : 'Блокировать' }}
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="border-t border-slate-200 p-5">
            {{ $users->links() }}
        </div>
    </section>
@endsection
