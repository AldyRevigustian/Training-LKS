@extends('layouts.master')

@section('content')
    <section class="container">
        <div class="section-header">
            <h1>Create kelas</h1>
        </div>
        <div class="section-body">
            <form action="{{ url('/kelas') }}" method="POST">

                @csrf
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name">

                <button type="submit" class="btn btn-primary float-end mt-3">Submit</button>
            </form>
        </div>
    </section>
@endsection
