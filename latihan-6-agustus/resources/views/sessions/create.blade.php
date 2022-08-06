@extends('layout.master')

@section('content')
    <div class="border-bottom mb-3 pt-3 pb-2">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <h1 class="h2">{{ $event->name }}</h1>
        </div>
        <span class="h6">{{ $event->date }}</span>
    </div>

    @if (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif

    <div class="mb-3 pt-3 pb-2">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <h2 class="h4">Create new session</h2>
        </div>
    </div>

    <form class="needs-validation" method="POST" novalidate action="{{ route('session.store', ['event' => $event->id]) }}">
        @csrf
        <div class="row">
            <div class="col-12 col-lg-4 mb-3">
                <label for="selectType">Type</label>
                <select class="form-control" id="selectType" name="type">
                    <option value="talk" selected>Talk</option>
                    <option value="workshop">Workshop</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-4 mb-3">
                <label for="inputTitle">Title</label>
                <!-- adding the class is-invalid to the input, shows the invalid feedback below -->
                <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="inputTitle"
                    name="title" placeholder="" value="">
                <div class="invalid-feedback">
                    {{ $errors->first('title') }}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-4 mb-3">
                <label for="inputSpeaker">Speaker</label>
                <input type="text" class="form-control {{ $errors->has('speaker') ? 'is-invalid' : '' }}"
                    id="inputSpeaker" name="speaker" placeholder="" value="">
                <div class="invalid-feedback">
                    {{ $errors->first('speaker') }}

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-4 mb-3">
                <label for="selectRoom">Room</label>
                <select class="form-control {{ $errors->has('room') ? 'is-invalid' : '' }}" id="selectRoom" name="room">
                    @foreach ($rooms as $room)
                        <option value="{{ $room->id }}">{{ $room->name }} / {{ $room->channel->name }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">
                    {{ $errors->first('room') }}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-4 mb-3">
                <label for="inputCost">Cost</label>
                <input type="number" class="form-control" id="inputCost" name="cost" placeholder="" value="0">
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-6 mb-3">
                <label for="inputStart">Start</label>
                <input type="text" class="form-control {{ $errors->has('start') ? 'is-invalid' : '' }}" id="inputStart"
                    name="start" placeholder="yyyy-mm-dd HH:MM" value="">
                <div class="invalid-feedback">
                    {{ $errors->first('start') }}

                </div>
            </div>
            <div class="col-12 col-lg-6 mb-3">
                <label for="inputEnd">End</label>
                <input type="text" class="form-control {{ $errors->has('end') ? 'is-invalid' : '' }}" id="inputEnd"
                    name="end" placeholder="yyyy-mm-dd HH:MM" value="">
                <div class="invalid-feedback">
                    {{ $errors->first('end') }}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 mb-3">
                <label for="textareaDescription">Description</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" id="textareaDescription"
                    name="description" placeholder="" rows="5"></textarea>
                <div class="invalid-feedback">
                    {{ $errors->first('description') }}

                </div>
            </div>
        </div>

        <hr class="mb-4">
        <button class="btn btn-primary" type="submit">Save session</button>
        <a href="events/detail.html" class="btn btn-link">Cancel</a>
    </form>
@endsection
