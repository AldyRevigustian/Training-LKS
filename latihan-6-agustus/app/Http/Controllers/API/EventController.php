<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Attendee;
use App\Models\Event;
use App\Models\EventTicket;
use App\Models\Organizer;
use App\Models\Registration;
use App\Models\SessionRegistration;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('organizer')->get();
        return response()->json([
            'events' => $events
        ]);
    }

    public function show($organizer_slug, $event_slug)
    {
        $organizer = Organizer::where('slug', $organizer_slug)->exists();

        if (!$organizer) return response()->json([
            'message' => "Organizer not found"
        ], 404);

        $event = Event::where('slug', $event_slug)->first();

        if (!$event) return response()->json([
            'message' => "Event not found"
        ], 404);

        $events = Event::with([
            'channels',
            'channels.rooms',
            'channels.rooms.sessions',
            'tickets'
        ])->where('slug', $event_slug)->whereHas('organizer', function ($q) use ($organizer_slug) {
            $q->where('slug', $organizer_slug);
        })->get();

        // $events = Event::with(['channels' => function($q){
        //     $q->with(['rooms' => function($q2){
        //         $q2->with('sessions');
        //     }]);
        // }, 'tickets'])

        // ->where('slug', $event_slug)->whereHas('organizer', function($q) use ($organizer_slug) {
        //     $q->where('slug', $organizer_slug);
        // })->get();
        return response()->json($events);
    }


    public function register(Request $request)
    {
        $ticket_id = $request->ticket_id;
        $session_ids = $request->session_ids ?: [];
        $token = $request->token;

        // return $session_ids;

        $user = Attendee::where('login_token', $token)->first();

        if (!$user) {
            return response()->json(['message' => 'User Not Login'], 401);
        }

        $checkEventRegister = Registration::where('attendee_id', $user->id)->where('ticket_id', $ticket_id)->first();

        if ($checkEventRegister) {
            return response()->json(["message" => "User already registered"]);
        }

        $ticket = EventTicket::find($ticket_id);
        if (!$ticket->getAvailableAttribute()) {
            return response()->json(['message' => 'Ticket is no longer available']);
        }

        $registration = Registration::create([
            'ticket_id' => $ticket->id,
            'attendee_id' => $user->id
        ]);



        for($i = 0; $i < count($session_ids); $i++) {
            SessionRegistration::create([
                'registration_id' => $registration->id,
                'session_id' => $session_ids[$i]
            ]);
        }


        return response()->json(['message' => "Registration successfull"]);
    }
}
