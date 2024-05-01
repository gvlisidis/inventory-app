<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Team\CreateTeamAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $request->validated();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($request->team){
            $team = app(CreateTeamAction::class)->create($request->team);
            $user->update(['team_id' => $team->id]);
        }

        Auth::login($user);

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
