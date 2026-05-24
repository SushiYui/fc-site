<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JoinController extends Controller
{
    public function guide()
    {
        return view('join.guide');

    }

    public function email()
    {
        return view('join.email');

    }
}
