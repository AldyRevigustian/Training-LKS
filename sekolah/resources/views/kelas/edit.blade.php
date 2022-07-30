@extends('layouts.master')

@section('content')
    <section class="container">
        <div class="section-header">
            <h1>Edit kelas {{ $data->name }}</h1>
        </div>
        <div class="section-body">
            <form action="{{ url('/kelas/'. $data->id) }}" method="POST">
                @csrf
                @method("PUT")
                <label for="name">Name</label>
                <input value="{{ $data->name }}" type="text" class="form-control" id="name" name="name">

                <button type="submit" class="btn btn-primary float-end mt-3">Submit</button>
            </form>
        </div>
    </section>
@endsection
