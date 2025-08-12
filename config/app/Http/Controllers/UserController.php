<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Models\User;

class UserController extends Controller
{
    // 登録フォームの表示
    public function create()
    {
        return view('users.UserRegister');
    }

    // 登録処理
    public function store(UserRegisterRequest $request)
    {
        $validated = $request->validated();

        // funclub_member を true に設定
        $validated['funclub_member'] = true;

        User::create($validated);

        return redirect()->route('users.complete');    }
}
