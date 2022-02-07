<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Todolist;
use App\Models\TVA;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            // 'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * ? Step one
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register1(Request $request)
    {
        $attr = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);


        event(new Registered($user = $this->create($request->all())));

        Auth::login($user);
        $bearerToken = Auth::user()->createToken('bearerToken')->plainTextToken;

        if (auth()->user()) {
            return response()->json([
                'message' => 'User registration step 1 successful',
                'data' => [
                    'user' => $user,
                    'bearerToken' => $bearerToken,
                ],
            ], 200);
        } else {
            return response()->json([
                'message' => 'Serveur has encountered an error.',
                'errors' => 'Mot de passe ou email invalides'
            ], 401);
        }
    }

    /**
     * Handle a registration request for the application.
     *
     * ? Step two
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register2(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'activity' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'phone' => 'required',
            'zip_code' => 'required',
        ]);

        $tva = TVA::create([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'activity' => $request->activity,
            'address' => $request->address,
            'city' => $request->city,
            'country' => $request->country,
            'phone' => $request->phone,
            'zip_code' => $request->zip_code,
        ]);


        return response()->json([
            'message' => 'Registration step 2 successful.',
            'data' => [
                'tva' => $tva,
            ],
        ], 200);
    }

    /**
     * Handle a registration request for the application.
     *
     * ? Step three
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register3(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->user_id = auth()->user()->id;
        $contact->save();

        Todolist::create([
            'user_id' => auth()->user()->id,
        ]);

        return response()->json([
            'message' => 'Registration step 3 successful.',
            'data' => [
                'contact' => $contact,
            ],
        ], 200);
    }
}
