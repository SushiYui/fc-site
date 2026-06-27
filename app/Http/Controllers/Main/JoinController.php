<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\PreMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PreMemberRegisterMail;
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

        $token = Str::random(64);

    PreMember::create([
        'email' => $request->email,
        'token' => $token,
    ]);

    Mail::to($request->email) ->send(new PreMemberRegisterMail($token));

        return Redirect()->route('join.complete');
    }

    public function complete()
    {
        return view('join.complete');
    }
}
