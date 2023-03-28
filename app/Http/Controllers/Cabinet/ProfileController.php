<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        return view('cabinet.profile.index');
    }
}
