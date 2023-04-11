<?php

namespace App\Http\Controllers\Admin;


use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::withoutGlobalScope('activity')
            ->positioned()
            ->paginate(20);

        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create')
            ->with('banner', new Banner());
    }

    public function store(BannerRequest $request): JsonResponse
    {
        $banner = Banner::create($request->safe()->all());
        Cache::forget('banners');

        session()->flash('flash', ['message' => 'Баннер добавлен']);

        return response()->json(['redirect' => route('admin.banners.edit', $banner)]);
    }

    public function edit(int $banner_id)
    {
        $banner = Banner::where('id', $banner_id)
            ->withoutGlobalScope('activity')
            ->firstOrFail();

        return view('admin.banners.edit', compact('banner'));
    }

    public function update(int $banner_id, BannerRequest $request): JsonResponse
    {
        $banner = Banner::where('id', $banner_id)
            ->withoutGlobalScope('activity')
            ->firstOrFail();

        $banner->update($request->safe()->all());
        Cache::forget('banners');

        session()->flash('flash', ['message' => 'Данные баннера обновлены']);

        return response()->json(['redirect' => route('admin.banners.edit', $banner)]);
    }

    public function destroy(int $banner_id): JsonResponse
    {
        Banner::withoutGlobalScope('activity')
            ->where('id', $banner_id)
            ->firstOrFail()
            ->delete();

        Cache::forget('banners');

        session()->flash('flash', ['message' => 'Баннер удалён']);

        return response()->json(['redirect' => route('admin.banners.index')]);
    }

    public function search(Request $request): string
    {
        $banners = Banner::where('name', 'like', "%{$request['token']}%")
            ->withoutGlobalScope('activity')
            ->take(10)
            ->get();

        if ($banners->isEmpty()) {
            return 'Ничего не найдено';
        }

        return View::make('admin.banners.table', compact('banners'))->render();
    }
}