<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\BrandRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::withoutGlobalScope('activity')
            ->withCount('reviews')
            ->positioned()
            ->paginate(20);

        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create')
            ->with('brand', new Brand());
    }

    public function store(BrandRequest $request): JsonResponse
    {
        $brand = Brand::create($request->safe()->all());

        session()->flash('flash', ['message' => 'Бренд добавлен']);

        return response()->json(['redirect' => route('admin.brands.edit', $brand)]);
    }

    public function edit(int $brand_id)
    {
        $brand = Brand::withoutGlobalScope('activity')
            ->where('id', $brand_id)
            ->firstOrFail();

        return view('admin.brands.edit', compact('brand'));
    }

    public function update(int $brand_id, BrandRequest $request): JsonResponse
    {
        $brand = Brand::withoutGlobalScope('activity')
            ->where('id', $brand_id)
            ->firstOrFail();

        $brand->update($request->safe()->all());

        session()->flash('flash', ['message' => 'Данные бренда обновлены']);

        return response()->json(['redirect' => route('admin.brands.edit', $brand)]);
    }

    public function search(Request $request): string
    {
        $brands = Brand::where('name', 'like', "%{$request['token']}%")
            ->withoutGlobalScope('activity')
            ->withCount('reviews')
            ->positioned()
            ->take(10)
            ->get();

        if ($brands->isEmpty()) {
            return 'Ничего не найдено';
        }

        return View::make('admin.brands.table', compact('brands'))->render();
    }

    public function destroy(int $brand_id): JsonResponse
    {
        Brand::withoutGlobalScope('activity')
            ->where('id', $brand_id)
            ->firstOrFail()
            ->delete();

        session()->flash('flash', ['message' => 'Бренд удалён']);

        return response()->json(['redirect' => route('admin.brands.index')]);
    }
}