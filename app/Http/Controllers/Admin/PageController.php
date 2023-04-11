<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Page;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Http\Requests\PageRequest;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::withCount('shops')
            ->paginate(20);

        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        $users = User::where('status', '=', 1)
            ->where('role', '>', 1)
            ->get();

        return view('admin.pages.create')
            ->with(['page' => new Page(), 'users' => $users]);
    }

    public function store(PageRequest $request): JsonResponse
    {
        $page = Page::create($request->safe()->except('shops'));
        $page
            ->shops()
            ->sync($request->safe()->only('shops')['shops']);

        Shop::flushAllCache();

        session()->flash('flash', ['message' => 'Страница добавлена']);

        return response()->json(['redirect' => route('admin.pages.edit', $page)]);
    }

    public function edit(Page $page)
    {
        $users = User::where('status', '=', 1)
            ->where('role', '>', 1)
            ->get();

        return view('admin.pages.edit', compact('page', 'users'));
    }

    public function update(Page $page, PageRequest $request): JsonResponse
    {
        tap($page, static fn(Page $page) => $page->update($request->safe()->except('shops')))
            ->shops()
            ->sync($request->safe()->only('shops')['shops']);

        Shop::flushAllCache();

        session()->flash('flash', ['message' => 'Страница обновлена']);

        return response()->json(['redirect' => route('admin.pages.edit', $page)]);
    }

    public function destroy()
    {
    }

    public function search(Request $request): string
    {
        $pages = Page::where('name', 'like', "%{$request['token']}%")
            ->orWhere('slug', 'like', "%{$request['token']}%")
            ->take(30)
            ->latest('id')
            ->get();

        if ($pages->isEmpty()) {
            return 'Ничего не найдено';
        }

        return View::make('admin.pages.table', compact('pages'))->render();
    }
}
