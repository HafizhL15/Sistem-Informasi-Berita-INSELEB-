@extends('dapur.layouts.main')

@section('container')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                {{-- @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif --}}
                <div class="text-center mt-1">
                    <h4 class="fw-bolder">LIST DATA REGISTRASI PENULIS</h4>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-12 mt-1">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title mt-2">Data Calon Penulis</h3>

                        <div class="card-tools my-2">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right"
                                    placeholder="Search">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr class="text-center">
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Email</th>
                                    <th>WhatsApp</th>
                                    <th>Tanggal Daftar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 14px">
                                @if ($calon->count())
                                    @foreach ($calon as $pendaftar)
                                        <tr>
                                            <td class="text-uppercase">{{ $pendaftar->name }}</td>
                                            <td>{{ $pendaftar->address }}</td>
                                            <td class="text-center">{{ $pendaftar->email }}</td>
                                            <td class="text-center">0{{ $pendaftar->phone }}</td>
                                            <td class="text-center">
                                                {{ $pendaftar->created_at->translatedFormat('l, d M Y - H:i') }} WIB</td>
                                            <td class="text-center">
                                                <a href="/dapur-imajinasi/ruangredaksi/pendaftar/{{ $pendaftar->id }}"
                                                    target="_blank" class="btn btn-sm bg-info"><i
                                                        class="fa-solid fa-eye"></i> Lihat</a>
                                                <a href="/dapur-imajinasi/ruangredaksi/pendaftar/{{ $pendaftar->id }}/edit"
                                                    class="btn btn-sm  bg-warning"><i class="fa-solid fa-edit"></i> Edit</a>
                                                <form action="/dapur-imajinasi/ruangredaksi/pendaftar/{{ $pendaftar->id }}"
                                                    method="post" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-sm bg-danger"
                                                        onclick="return confirm('Yakin mau hapus user {{ $pendaftar->name }}?')"><i
                                                            class="fa-solid fa-trash"></i> Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="6">Tidak ada data yang ditemukan</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <div class="mx-3 mt-3">
                            {{ $calon->links() }}
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>

    </section>
    <!-- /.content -->

    @include('sweetalert::alert')
@endsection
