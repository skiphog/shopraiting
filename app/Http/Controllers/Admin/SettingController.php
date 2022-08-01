<?php

namespace App\Http\Controllers\Admin;

use App\Services\SiteMap;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.settings.index');
    }

    public function sitemap(SiteMap $siteMap): JsonResponse
    {
        return response()->json(['result' => $siteMap->makeSiteMap()]);
    }
}
