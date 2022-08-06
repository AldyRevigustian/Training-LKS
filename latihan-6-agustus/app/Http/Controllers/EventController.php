<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    //
    public function index(){
        $events = Event::where('organizer_id', Auth::user()->id)->get();
        return view('events.index', compact('events'));
    }

    public function show(Event $event){
        return view('events.show', compact('event'));
    }

    // public function index(){
    //     return view('event.index');
    // }

}
