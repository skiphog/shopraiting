<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name'     => ['required', 'string', 'min:3', 'max:255'],
            'email'    => ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::min(6)],
            'tos'      => ['accepted']
        ]);

        $user = User::create([
            'name'     => $request['name'],
            'email'    => $request['email'],
            'slug'     => $this->generateSlug($request['name']),
            'password' => Hash::make($request['password']),
            'role'     => User::ROLES['AUTHOR']
        ]);

        event(new Registered($user));

        Auth::login($user, true);

        return response()->json(['redirect' => url(RouteServiceProvider::CABINET)]);
    }

    /**
     * @param string $string
     *
     * @return string
     */
    private function generateSlug(string $string): string
    {
        $slug = str($string)->slug()->toString();

        for ($i = 1; User::where('slug', $slug)->exists(); $i++) {
            $slug .= $i;
        }

        return $slug;
    }
}
