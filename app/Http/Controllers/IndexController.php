<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $shops = Shop::select(['id', 'name'])->positioned()->get();

        return view('index', compact('shops'));
    }
}
