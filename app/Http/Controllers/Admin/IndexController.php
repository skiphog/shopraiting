<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shop;
use App\Models\Review;
use App\Models\Article;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return view('admin.index')
            ->with([
                'shops_cnt' => Shop::count(),
                'reviews_cnt' => Review::count(),
                'articles_cnt' => Article::count()
            ]);
    }
}
