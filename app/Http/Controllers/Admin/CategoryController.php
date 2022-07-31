<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

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
    }

    public function store()
    {
    }

    public function edit(Category $category)
    {
    }

    public function update(Category $category)
    {
    }

    public function destroy()
    {
    }

    public function search(Request $request): string
    {
        $categories = Category::where('name', 'like', "%{$request['token']}%")
            ->take(30)
            ->get();

        if ($categories->isEmpty()) {
            return 'Ничего не найдено';
        }

        return View::make('admin.categories.table', compact('categories'))->render();
    }
}
