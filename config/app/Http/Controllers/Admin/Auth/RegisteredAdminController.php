<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Hash;

class RegisteredAdminController extends Controller
{
    public function create()
    {
        return view('admin.adminNewsCreate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:100'],
            'body' => ['required', 'string', 'max:1000'],
        ]);

        News::create([
            'title' => $request->title,
            'body' => $request->body,
            'published_at' => now(),
        ]);

        return redirect()->route('fanclub.home')->with('success', '投稿完了！');
    }
}
