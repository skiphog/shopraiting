<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('shops')
            ->paginate(20);

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $users = User::where('status', '=', 1)
            ->where('role', '>', 1)
            ->get();

        return view('admin.categories.create')
            ->with(['category' => new Category(), 'users' => $users]);
    }

    public function store(CategoryRequest $request): JsonResponse
    {
        $category = Category::create($request->safe()->except('shops'));
        $category
            ->shops()
            ->sync($request->safe()->only('shops')['shops']);

        session()->flash('flash', ['message' => 'Категория добавлена']);

        return response()->json(['redirect' => route('admin.categories.edit', $category)]);
    }

    public function edit(Category $category)
    {
        $users = User::where('status', '=', 1)
            ->where('role', '>', 1)
            ->get();

        return view('admin.categories.edit', compact('category', 'users'));
    }

    public function update(Category $category, CategoryRequest $request): JsonResponse
    {
        tap($category, static fn(Category $category) => $category->update($request->safe()->except('shops')))
            ->shops()
            ->sync($request->safe()->only('shops')['shops']);

        session()->flash('flash', ['message' => 'Категория обновлена']);

        return response()->json(['redirect' => route('admin.categories.edit', $category)]);
    }

    public function destroy()
    {
    }

    public function search(Request $request): string
    {
        $categories = Category::where('name', 'like', "%{$request['token']}%")
            ->orWhere('slug', 'like', "%{$request['token']}%")
            ->take(30)
            ->latest('id')
            ->get();

        if ($categories->isEmpty()) {
            return 'Ничего не найдено';
        }

        return View::make('admin.categories.table', compact('categories'))->render();
    }
}
