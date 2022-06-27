<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function authors()
    {
        $users = User::where('role', 2)
            ->with(['articles' => static fn($q) => $q->select(['id', 'user_id', 'slug', 'name'])->latest('id')])
            ->get();

        return view('users.authors', compact('users'));
    }
}
