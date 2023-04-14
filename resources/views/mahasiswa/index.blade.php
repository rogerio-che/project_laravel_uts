@extends('layouts.template ')
@section('content')
        <div class="my-5 p-5 bg-body rounded shadow-sm">
                <h1 class="text-center mb-3">Data Mahasiswa</h1>

                <!-- FORM PENCARIAN -->
                <div class="pb-3">
                  <form class="d-flex" action="" method="get">
                      <input class="form-control me-1" type="search" name="keyword" value="{{ Request::get('keyword') }}" placeholder="Cari data mahasiswa" aria-label="Search">
                      <button class="btn btn-secondary" type="submit">Cari</button>
                  </form>
                </div>
                
                <!-- TOMBOL TAMBAH DATA -->
                <div class="pb-3">
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">+ Tambah Data</button>
                </div>
                <table class="table table-striped table-dark table-hover">
                    <thead>
                        <tr>
                            <th class="col-md-1">No</th>
                            <th class="col-md-3">NIM</th>
                            <th class="col-md-4">Nama</th>
                            <th class="col-md-2">Jurusan</th>
                            <th class="col-md-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = $dataMhs->firstItem() ?>
                        @foreach ($dataMhs as $item)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $item->nim }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->jurusan }}</td>
                            <td>
                                <a href='{{url('mahasiswa/'.$item->nim.'/edit')}}' class="btn btn-warning btn-sm">Edit</a>
                                {{-- <a type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{$item->nim}}">Edit</a> --}}
                                <form onsubmit="return confirm('Yakin akan menghapus?')" class="d-inline" action="{{ url('mahasiswa/'.$item->nim) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" name="submit" class="btn btn-danger btn-sm">Del</button>
                                </form>
                            </td>
                        </tr>
                        <?php $i++ ?>
                        @endforeach
                    </tbody>
                </table>
                {{ $dataMhs->withQueryString()->links() }}
          </div>
          <!-- AKHIR DATA -->
        @endsection
