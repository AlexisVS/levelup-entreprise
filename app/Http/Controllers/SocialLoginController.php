<?php

namespace App\Http\Controllers;

use App\Models\Todolist;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function __construct() {
        $this->middleware('guest');
    }



    /**
     * Redire the user to google login provider.
     *
     * @return Illuminate\Http\Response
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Take the user providing to google login provider
     * and log in the user
     *
     * @return \Illuminate\Http\Response
     */
    public function handleCallback()
    {
        // try {
            $user = Socialite::driver('google')->stateless()->user();
            $finduser = User::where('email', $user->email)->first();
            if ($finduser) {
                User::where('email',  $user->email)->update([
                    'google_id' => $user->id,
                ]);
                $correctUser = Auth::loginUsingId($finduser->id);
                Auth::login($correctUser);
                return redirect('/home');
            }
        // } catch (Exception $e) {
        //     dd($e);
        // }
    }
}
