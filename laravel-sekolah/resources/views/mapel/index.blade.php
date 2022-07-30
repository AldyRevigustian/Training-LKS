@extends('layouts.master')

@section('content')
<section class="container" >
    <div class="section-header">
        <h1>mapel</h1>
    </div>
    <div class="section-body">
        <a href="{{ url('mapel/create') }}" class="btn btn-primary float-end my-2">Create</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nama</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($data as $mapel)
                <tr>
                    <td>{{ $mapel->id }}</td>
                    <td>{{ $mapel->name }}</td>
                    <td>
                        <a href="{{ url("/mapel/" .$mapel->id. "/edit") }}" class="btn btn-warning">Edit</a>
                        {{-- <a href="{{ url("/mapel/".$mapel->id) }}" class="btn btn-danger">Delete</a> --}}
                        <form action="{{ url("/mapel/".$mapel->id) }}" method="POST">
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
