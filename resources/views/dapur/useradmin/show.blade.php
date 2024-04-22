@extends('dapur.layouts.main')

@section('container')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="text-center">
                    <h4 class="text-center">Detail User</h4>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="container">

            <div class="text-center">
                @if ($useradmin->image)
                    <img src="{{ asset('storage/' . $useradmin->image) }}" alt="{{ $useradmin->name }}" class="rounded my-1"
                        style="height: 180px; width: 180px;  object-fit: cover">
                @else
                    <img src="{{ asset('img/avatar.png') }}" alt="{{ $useradmin->name }}"
                        class="img-size-64 img-fluid img-circle my-1">
                @endif
            </div>
            <h5 class="my-3 text-center fw-bolder">{{ $useradmin->name }}</h5>
            <div class="mt-5 mb-3">
                <a href="/dapur-imajinasi/ruangredaksi/useradmin" class="btn btn-success btn-sm">Kembali</a>
                <a href="/dapur-imajinasi/ruangredaksi/useradmin/{{ $useradmin->id }}/edit"
                    class="btn btn-warning btn-sm">Edit</a>
                <form action="/dapur-imajinasi/ruangredaksi/useradmin/{{ $useradmin->id }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Yakin mau hapus user {{ $useradmin->name }}?')">Hapus</button>
                </form>
            </div>


            <div class="my-3">
                <!-- card -->
                <div class="card">
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tbody>
                                <tr>
                                    <th>Nama Lengkap</th>
                                    <td>{{ $useradmin->name }}</td>
                                </tr>
                                <tr>
                                    <th>Username</th>
                                    <td>{{ $useradmin->username }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $useradmin->email }}</td>
                                </tr>
                                <tr>
                                    <th>No. HP</th>
                                    <td>0{{ $useradmin->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>{{ $useradmin->address }}</td>
                                </tr>
                                <tr>
                                    <th>Otorisasi</th>
                                    <td>{{ $useradmin->roleadmin->role }}</td>
                                </tr>
                            </tbody>
                            </thead>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <div>
                    <a href="/dapur-imajinasi/ruangredaksi/useradmin/editpassword/{{ $useradmin->id }}/edit"
                        class="btn btn-warning btn-sm">Ubah
                        Password</a>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
@endsection
