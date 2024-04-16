<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Team\CreateTeamAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Team;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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

    public function store(Request $request)
    {

        try {
            //Validated
            $validateUser = Validator::make($request->all(),
                [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                    'team' => ['sometimes', 'nullable', 'string', 'min:4', 'max:100'],
                    'password' => ['required', 'confirmed', Rules\Password::defaults()],
                ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ], 201);


            if ($request->team){
                $team = app(CreateTeamAction::class)->create($request->team);
                $user->update(['team_id' => $team->id]);
            }

            return response()->json([
                'status' => true,
                'user' => new UserResource($user),
                'message' => 'User Created Successfully',
                'token' => $user->createToken("API_TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
