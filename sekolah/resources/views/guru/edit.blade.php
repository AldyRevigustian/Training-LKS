@extends('layouts.master')

@section('content')
    <section class="container">
        <div class="section-header">
            <h1>Edit Guru {{ $data->name }}</h1>
        </div>
        <div class="section-body">
            <form action="{{ url('/guru/'. $data->id) }}" method="POST">
                @csrf
                @method("PUT")
                <label for="name">Name</label>
                <input value="{{ $data->name }}" type="text" class="form-control" id="name" name="name">

                <label for="address">Address</label>
                <textarea class="form-control" id="address" name="address">{{ $data->address }}</textarea>

                <label for="dob">DOB</label>
                <input value="{{ $data->dob }}" type="date" class="form-control" id="dob" name="dob">

                <label for="gender">Gender</label>
                <div class="">
                    <input type="radio" name="gender" id="L" value="L"
                        {{ $data->gender == 'L' ? 'checked' : '' }}>
                    <label for="L">Laki Laki</label>
                    <input type="radio" name="gender" id="P" value="P"
                        {{ $data->gender == 'P' ? 'checked' : '' }}>
                    <label for="P">Perempuan</label>
                </div>

                <button type="submit" class="btn btn-primary float-end mt-3">Submit</button>
            </form>
        </div>
    </section>
@endsection
