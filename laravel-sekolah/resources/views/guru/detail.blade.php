@extends('layouts.master')

@section('content')
<section class="container" >
    <div class="section-header">
        <h1>Guru</h1>
    </div>
    <div class="section-body">
        <table class="table table-bordered">
            <tr>
                <td>Nama</td>
                <td>{{ $guru->name }}</td>
            </tr>
            <tr>
                <td>Dob</td>
                <td>{{ $guru->dob }}</td>
            </tr>
            <tr>
                <td>Address</td>
                <td>{{ $guru->address }}</td>
            </tr>
            <tr>
                <td>Gender</td>
                <td>{{ $guru->gender }}</td>
            </tr>
            <tr>
                <td>Mengajar</td>
                <td>
                    <ul>
                        @foreach ($guru->mengajar as $mengajar)
                        <li>Mengajar Kelas {{$mengajar->kelas->name}} dalam mata pelajaran {{ $mengajar->mapel->name }}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
        </table>
        <a href="{{ url('guru') }}" class="btn btn-primary">Back</a>
    </div>
</section>
@endsection
