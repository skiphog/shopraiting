<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest('id')
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