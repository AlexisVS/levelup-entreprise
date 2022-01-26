<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    /**
     * Return the current user profile
     * 
     * @return \Illuminate\Http\Response
     */
    public function getUser()
    {
        if (Auth::check()) {
            return response()->json([
                'message' => 'User taked successfully.',
                'data' => [
                    'user' => auth()->user(),
                    'tva' => auth()->user()->tvas,
                    'contact' => auth()->user()->contacts
                ],
            ], 200);
        } else {
            return response()->json([
                'message' => 'Problem for retrieve current user profile'
            ], 401);
        }
    }

    /**
     * Edit the profile of the current user
     * 
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function editProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        $user = auth()->user();
        $user->contacts->name = $request->name;
        $user->contacts->email = $request->email;
        $user->contacts->phone = $request->phone;
        $user->contacts->save();

        return response()->json([
            'message' => 'Profile updated successfully.',
            'data' => [
                'user' => $user,
                'contacts' => $user->contacts,
            ]
        ], 200);
    }
}
