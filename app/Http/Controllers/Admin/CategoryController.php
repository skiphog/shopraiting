<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('shops')
            ->paginate(20);

        dump($categories);
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

    public function search(Request $request)
    {
    }
}
