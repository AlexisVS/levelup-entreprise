<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use AuthenticatesUsers;
    use RegistersUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }

    // /**
    //  * The user has been registered.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  mixed  $user
    //  * @return mixed
    //  */
    // protected function registered(Request $request, $user)
    // {
    //     //
    // }

    /* -------------------------------------------------------------------------- */
    /*                                    Login                                   */
    /* -------------------------------------------------------------------------- */

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // $this->username() a la place de 'username'
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->sendFailedLoginResponse($request);
        } else {
            $this->validateLogin($request);
            return $this->sendLoginResponse($request);
        }
    }
}
