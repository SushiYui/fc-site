<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
        'name' => ['required', 'string', 'max:20'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'confirmed', 'min:4', 'regex:/^[a-zA-Z0-9]+$/'],
        'postal_code' => ['required', 'digits:7'],
        'city' => ['required', 'string'],
        'building' => ['nullable', 'string'],
        'phone_number' => ['required', 'regex:/^\d{10,11}$/'],
        'funclub_member' => ['nullable'],
            ]);

        $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'postal_code' => $request->postal_code,
        'city' => $request->city,
        'building' => $request->building,
        'phone_number' => $request->phone_number,
        'funclub_member' => $request->has('funclub_member'),
            ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
