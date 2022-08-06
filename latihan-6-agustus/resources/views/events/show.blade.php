@extends('layout.master')

@section('content')
    <div class="border-bottom mb-3 pt-3 pb-2 event-title">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <h1 class="h2">{{ $event->name }}</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <a href="{{ url('/events/' . $event->id . '/edit') }}" class="btn btn-sm btn-outline-secondary">Edit
                        event</a>
                </div>
            </div>
        </div>
        <span class="h6">{{ $event->date }}</span>
    </div>

    <!-- Tickets -->
    <div id="tickets" class="mb-3 pt-3 pb-2">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <h2 class="h4">Tickets</h2>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <a href="tickets/create.html" class="btn btn-sm btn-outline-secondary">
                        Create new ticket
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row tickets">
        @foreach ($event->tickets as $ticket)
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $ticket->name }}</h5>
                        <p class="card-text">{{ $ticket->cost }}.-</p>
                        @if ($ticket->special_validity !== null)
                            @php
                                $special_validity = json_decode($ticket->special_validity);
                            @endphp
                            @if ($special_validity->type == 'amount')
                                <p class="card-text">{{ $special_validity->amount }} tickets available</p>
                            @endif

                            @if ($special_validity->type == 'date')
                                <p class="card-text">Available until {{ $special_validity->date }}</p>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Sessions -->
    <div id="sessions" class="mb-3 pt-3 pb-2">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <h2 class="h4">Sessions</h2>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <a href="sessions/create.html" class="btn btn-sm btn-outline-secondary">
                        Create new session
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive sessions">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Time</th>
                    <th>Type</th>
                    <th class="w-100">Title</th>
                    <th>Speaker</th>
                    <th>Channel</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($event->rooms as $room)
                    @foreach ($room->sessions as $session)
                        <tr>
                            <td class="text-nowrap">{{ date('H:i', strtotime($session->start)) }} -
                                {{ date('H:i', strtotime($session->end)) }}</td>
                            <td>{{ ucfirst($session->type) }}</td>
                            <td><a href="{{ url('/events/'. $event->id. '/sessions/' . $session->id)}}">{{ $session->title }}</a></td>
                            <td class="text-nowrap">{{ $session->speaker }}</td>
                            <td class="text-nowrap">{{  $room->channel->name }} / {{ $room->name }}</td>
                        </tr>
                    @endforeach
                @endforeach

            </tbody>
        </table>
    </div>

    <!-- Channels -->
    <div id="channels" class="mb-3 pt-3 pb-2">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <h2 class="h4">Channels</h2>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <a href="channels/create.html" class="btn btn-sm btn-outline-secondary">
                        Create new channel
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row channels">
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Main</h5>
                    <p class="card-text">3 sessions, 1 room</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Side</h5>
                    <p class="card-text">15 sessions, 2 rooms</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Rooms -->
    <div id="rooms" class="mb-3 pt-3 pb-2">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <h2 class="h4">Rooms</h2>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <a href="rooms/create.html" class="btn btn-sm btn-outline-secondary">
                        Create new room
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive rooms">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Capacity</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Room A</td>
                    <td>1,000</td>
                </tr>
                <tr>
                    <td>Room B</td>
                    <td>100</td>
                </tr>
                <tr>
                    <td>Room C</td>
                    <td>100</td>
                </tr>
                <tr>
                    <td>Room D</td>
                    <td>250</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
