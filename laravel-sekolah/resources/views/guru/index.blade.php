@extends('layouts.master')

@section('content')
<section class="container" >
    <div class="section-header">
        <h1>Guru</h1>
    </div>
    <div class="section-body">
        <a href="{{ url('guru/create') }}" class="btn btn-primary float-end my-2">Create</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nama</th>
                    <th>Address</th>
                    <th>Date Of Birth</th>
                    <th>Gender</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $gurus)
                <tr>
                    <td>{{ $gurus->id }}</td>
                    <td>{{ $gurus->name }}</td>
                    <td>{{ $gurus->address }}</td>
                    <td>{{ $gurus->dob }}</td>
                    <td>{{ $gurus->gender }}</td>
                    <td>
                        <a href="{{ url("/guru/" .$gurus->id. "/edit") }}" class="btn btn-warning">Edit</a>
                        {{-- <a href="{{ url("/guru/".$gurus->id) }}" class="btn btn-danger">Delete</a> --}}
                        <form action="{{ url("/guru/".$gurus->id) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection
