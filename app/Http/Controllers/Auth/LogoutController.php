<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * Logout the current user
     * 
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     *  */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
    }
}
