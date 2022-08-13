<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Attendee;
use App\Models\Registration;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function registration(Request $request){
        $token = $request->token;

        $attendee = Attendee::where('login_token', $token)->first();

        if(!$attendee){
            return response()->json([
                'User is not logged in'
            ]);
        }

        $registration = Registration::with('event','event.organizer','session_registrations')->where('attendee_id', $attendee->id)->get();

        return response()->json([
            'registrations' => $registration
        ]);
    }
}
