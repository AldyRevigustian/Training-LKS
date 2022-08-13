<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Attendee;
use App\Models\Event;
use App\Models\EventTicket;
use App\Models\Registration;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //

    public function login(Request $request)
    {
        $credentials = [
            'lastname' => $request->lastname,
            'registration_code' => $request->registration_code
        ];

        $attendee = Attendee::where($credentials)->first();

        if (!$attendee) {
            return response()->json([
                "message" => "Invalid Login"
            ], 401);
        }

        $token = md5($attendee->username);
        $attendee->update([
            'login_token' => $token
        ]);

        return response()->json([
            'firstname' => $attendee->firstname,
            'lastename' => $attendee->lastename,
            'username' => $attendee->username,
            'email' => $attendee->email,
            'token' => $token,
        ]);
    }

    public function logout(Request $request){
        $token = $request->get('token');

        $attendee = Attendee::where('login_token', $token)->first();

        if(!$attendee) return response()->json(['message'=>'Invalid token'], 401);


        $attendee->update([
            'login_token' => NULL
        ]);

        return response()->json([
            'message' => 'Logout Success'
        ]);
    }

}

