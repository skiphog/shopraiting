<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Http\Requests\CityRequest;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::withCount('shops')
            ->paginate(20);

        return view('admin.cities.index', compact('cities'));
    }

    public function create()
    {
        $users = User::where('status', '=', 1)
            ->where('role', '>', 1)
            ->get();

        return view('admin.cities.create')
            ->with(['city' => new City(), 'users' => $users]);
    }

    public function store(CityRequest $request): JsonResponse
    {
        $city = City::create($request->safe()->except('shops'));
        $city
            ->shops()
            ->sync($request->safe()->only('shops')['shops']);

        session()->flash('flash', ['message' => 'Город добавлен']);

        return response()->json(['redirect' => route('admin.cities.edit', $city)]);
    }

    public function edit(City $city)
    {
        $users = User::where('status', '=', 1)
            ->where('role', '>', 1)
            ->get();

        return view('admin.cities.edit', compact('city', 'users'));
    }

    public function update(City $city, CityRequest $request): JsonResponse
    {
        tap($city, static fn(City $city) => $city->update($request->safe()->except('shops')))
            ->shops()
            ->sync($request->safe()->only('shops')['shops']);

        session()->flash('flash', ['message' => 'Город обновлён']);

        return response()->json(['redirect' => route('admin.cities.edit', $city)]);
    }

    public function destroy()
    {
    }

    public function search(Request $request): string
    {
        $cities = City::where('name', 'like', "%{$request['token']}%")
            ->take(30)
            ->latest('id')
            ->get();

        if ($cities->isEmpty()) {
            return 'Ничего не найдено';
        }

        return View::make('admin.cities.table', compact('cities'))->render();
    }
}
