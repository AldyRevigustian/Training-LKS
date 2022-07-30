@extends('layouts.master')

@section('content')
<section class="container" >
    <div class="section-header">
        <h1>Kelas</h1>
    </div>
    <div class="section-body">
        <a href="{{ url('kelas/create') }}" class="btn btn-primary float-end my-2">Create</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nama</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($data as $kelas)
                <tr>
                    <td>{{ $kelas->id }}</td>
                    <td>{{ $kelas->name }}</td>
                    <td>
                        <a href="{{ url("/kelas/" .$kelas->id. "/edit") }}" class="btn btn-warning">Edit</a>
                        {{-- <a href="{{ url("/kelas/".$kelas->id) }}" class="btn btn-danger">Delete</a> --}}
                        <form action="{{ url("/kelas/".$kelas->id) }}" method="POST">
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
