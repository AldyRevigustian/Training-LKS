@extends('layouts.master')

@section('content')
    <section class="container">
        <div class="section-header">
            <h1>Create Guru</h1>
        </div>
        <div class="section-body">
            <form action="{{ url('/guru') }}" method="POST">

                @csrf
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name">

                <label for="address">Address</label>
                <textarea class="form-control" id="address" name="address"> </textarea>

                <label for="dob">DOB</label>
                <input type="date" class="form-control" id="dob" name="dob">

                <label for="gender">Gender</label>
                <div class="">
                    <input type="radio" name="gender" id="L" value="L">
                    <label for="L">Laki Laki</label>
                    <input type="radio" name="gender" id="P" value="P">
                    <label for="P">Perempuan</label>
                </div>


                <div class="mt-5">
                    <div class="row">
                        <div class="col-6">
                            <label for="kelas">Kelas</label>
                            <select name="kelas[]" id="kelas" class="form-control">
                                @foreach ($kelas as $per_kelas)
                                <option value="{{ $per_kelas->id }}">{{ $per_kelas->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-6">
                            <label for="mapel">Mapel</label>
                            <select name="mapel[]" id="mapel" class="form-control">
                                @foreach ($mapels as $mapel )
                                <option value="{{ $mapel->id }}">{{ $mapel->name }}</option>
                                @endforeach
                            </select>
                            <button type="button" class="btn btn-secondary btn-sm float-end" id="tambah-kelas">
                                + Tambah Kelas
                            </button>
                        </div>

                    </div>
                </div>

                {{-- <form action="">

                </form> --}}

                <button type="submit" class="btn btn-primary float-end mt-3">Submit</button>
            </form>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        let form = document.querySelector('form')
        let button = document.querySelector('tambah-kelas')
    </script>
@endpush
