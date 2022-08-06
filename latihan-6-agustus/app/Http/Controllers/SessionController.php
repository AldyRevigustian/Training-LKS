<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    //
    public function create($event){
        $event = Event::find($event);
        $rooms = $event->rooms;
        return view('sessions.create', compact('event','rooms'));
    }

    public function store(Request $request, $event){
        $request->validate([
            'type' => 'required',
            'title' => 'required',
            'speaker' => 'required',
            'start' => 'required|date',
            'end' => 'required|date',
            'room' => 'required',
            'description' => 'required',
        ]);

        $start = $request->start;
        $end = $request->end;

        $checkSession = Session::where('room_id', $request->room)
            ->where(function($query) use ($start,$end){
            $query->whereBetween('start', [$start,$end])
                ->orWhereBetween('end', [$start,$end]);
        })->exists();

        if($checkSession){
            session()->flash('error', 'Bentrok');
            return redirect()->back();
        }

        $session = Session::create([
            'type' => $request->type,
            'title' => $request->title,
            'speaker' => $request->speaker,
            'start' => $request->start,
            'end' => $request->end,
            'room_id' => $request->room,
            'description' => $request->description,
            'cost' => $request->cost ?: NULL,
        ]);

        session()->flash('success', 'Session successfully created');
        return redirect("/events/{$event}");
    }
}
