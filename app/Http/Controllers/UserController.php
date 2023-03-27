<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Banner;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    public function index()
    {
        $users = User::authors()->get();

        return view('users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user->load(['articles' => static fn($q) => $q->select(['id', 'user_id', 'slug', 'name'])->latest('id')]);
        $banners = Cache::rememberForever('banners', static fn() => Banner::all());

        return view('users.show', compact('user', 'banners'));
    }
}
