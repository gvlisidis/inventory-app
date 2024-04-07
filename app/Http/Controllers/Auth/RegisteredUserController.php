<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Team\CreateTeamAction;
use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\User;
use App\Providers\RouteServiceProvider;
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

    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'team' => ['required', 'string', 'min:4', 'max:100'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

       $team = app(CreateTeamAction::class)->create($request->team);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $team->users()->attach($user);

        Auth::login($user);

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
