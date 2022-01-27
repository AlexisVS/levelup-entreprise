<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function login(Request $request)
    {
        $attr = $request->validate([
            // $this->username() a la place de 'username'
            'email' => 'required|string',
            'password' => 'required|string',
        ]);


        if (!Auth::attempt($attr)) {
            return response()->json([
                'message' => 'Serveur has encountered an error.',
                'errors' => 'Mot de passe ou email invalides',
            ], 401);
        }

        return response()->json([
            'message' => 'Vous ete connecter',
            'data' => [
                'user' => auth()->user(),
                'bearerToken' => 'Bearer ' . Auth::user()->createToken('bearerToken')->plainTextToken
            ],
        ], 200);
    }
}
