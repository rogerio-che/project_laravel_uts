@extends('layouts.template')
{{-- @extends('mahasiswa.index') --}}
@section('content')
{{-- FORM EDIT DATA --}}
            <form action='{{url('mahasiswa/'.$dataMhs->nim)}}' method='post'>
                @csrf
                @method('PUT')
                <div class="my-3 p-3 bg-body rounded shadow-sm">
                    <a href="{{url('mahasiswa')}}" class="btn btn-secondary mb-3"><< Back</a>
                    <h1 class="mb-5 text-center">Edit Data Mahasiswa</h1>
                    <div class="mb-3 row">
                        <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                        <div class="col-sm-10">
                            {{ $dataMhs->nim }}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name='nama' value="{{ $dataMhs->nama }}" id="nama">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name='jurusan' value="{{  $dataMhs->jurusan }}" id="jurusan">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jurusan" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button></div>
                    </div>
                </div>
            </form>
{{-- END EDIT FORM --}}
@endsection

<!-- START FORM -->

{{-- <form action='{{url('mahasiswa/'.$dataMhs->nim)}}' method='post'>
    @csrf
    @method('PUT')
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <a href="{{url('mahasiswa')}}" class="btn btn-secondary mb-3"><< Back</a>
        <div class="mb-3 row">
            <label for="nim" class="col-sm-2 col-form-label">NIM</label>
            <div class="col-sm-10">
                {{ $dataMhs->nim }}
            </div>
        </div>
        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='nama' value="{{ $dataMhs->nama }}" id="nama">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='jurusan' value="{{  $dataMhs->jurusan }}" id="jurusan">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="jurusan" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button></div>
        </div>
    </div>
</form> --}}

<!-- AKHIR FORM -->