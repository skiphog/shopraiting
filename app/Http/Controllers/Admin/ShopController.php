<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ShopRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class ShopController extends Controller
{
    public function index()
    {
        $shops = Shop::withoutGlobalScope('activity')
            ->withCount('reviews')
            ->withCount(['coupons' => static fn($q) => $q->withTrashed()])
            ->positioned()
            ->paginate(20);

        return view('admin.shops.index', compact('shops'));
    }

    public function create()
    {
        return view('admin.shops.create')
            ->with('shop', new Shop());
    }

    public function store(ShopRequest $request): JsonResponse
    {
        $shop = Shop::create($request->safe()->all());
        Shop::flushAllCache();

        session()->flash('flash', ['message' => 'Магазин добавлен']);

        return response()->json(['redirect' => route('admin.shops.edit', $shop)]);
    }

    /**
     * Здесь не inject модель, т.к. я не нашел способ это сделать с withoutGlobalScope.
     */
    public function edit(int $shop_id)
    {
        $shop = Shop::withoutGlobalScope('activity')
            ->withCount(['coupons' => static fn($q) => $q->withTrashed()])
            ->with(['coupons' => static fn($q) => $q->withTrashed()->oldest('id')])
            ->where('id', $shop_id)
            ->firstOrFail();

        return view('admin.shops.edit', compact('shop'));
    }

    /**
     * Здесь не inject модель, т.к. я не нашел способ это сделать с withoutGlobalScope.
     */
    public function update(int $shop_id, ShopRequest $request): JsonResponse
    {
        $shop = Shop::withoutGlobalScope('activity')
            ->where('id', $shop_id)
            ->firstOrFail();

        $shop->update($request->safe()->all());
        Shop::flushAllCache();

        session()->flash('flash', ['message' => 'Данные магазина обновлены']);

        return response()->json(['redirect' => route('admin.shops.edit', $shop)]);
    }

    public function search(Request $request): string
    {
        $shops = Shop::where('name', 'like', "%{$request['token']}%")
            ->withoutGlobalScope('activity')
            ->withCount('reviews')
            ->positioned()
            ->take(10)
            ->get();

        if ($shops->isEmpty()) {
            return 'Ничего не найдено';
        }

        return View::make('admin.shops.table', compact('shops'))->render();
    }

    public function destroy()
    {
    }
}
