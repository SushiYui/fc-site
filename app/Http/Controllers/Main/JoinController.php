<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\PreMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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

    public function store(Request $request)
    {

    // あとでめーアドレス保存、トークン生成、メールアドレス送信処理記載
    PreMember::create([
        'email' => $request->email,
    ]);

        return Redirect()->route('join.complete');
    }

    public function complete()
    {
        return view('join.complete');
    }
}
