<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::oldest('id')
            ->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(User $user, UserRequest $request): JsonResponse
    {
        $user->update($request->safe()->all());

        session()->flash('flash', ['message' => 'Информация о пользователе обновлена']);

        return response()->json(['redirect' => route('admin.users.edit', $user)]);
    }

    public function password(User $user, Request $request): JsonResponse
    {
        $this->validate($request, [
            'password' => ['required', 'string', 'confirmed', 'min:6']
        ]);

        $user->update(['password' => Hash::make($request['password'])]);

        session()->flash('flash', ['message' => 'Пароль обновлён']);

        return response()->json(['redirect' => route('admin.users.edit', $user)]);
    }

    public function search(Request $request): string
    {
        $users = User::where('name', 'like', "%{$request['token']}%")
            ->orWhere('email', 'like', "%{$request['token']}%")
            ->take(10)
            ->get();

        if ($users->isEmpty()) {
            return 'Ничего не найдено';
        }

        return View::make('admin.users.table', compact('users'))->render();
    }
}