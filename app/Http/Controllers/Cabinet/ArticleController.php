<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function index()
    {
        return view('cabinet.articles.index');
    }
}
