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
                @if (auth()->user()->image)
                    <img src="{{ asset('storage/' . auth()->user()->image) }}" alt="{{ auth()->user()->name }}"
                        class="rounded my-1" style="height: 180px; width: 180px;  object-fit: cover">
                @else
                    <img src="{{ asset('img/avatar.png') }}" alt="{{ auth()->user()->name }}"
                        class="img-size-64 img-fluid img-circle my-1">
                @endif
            </div>
            <h5 class="my-3 text-center fw-bolder">{{ auth()->user()->name }}</h5>
            <div class="mt-5 mb-3">
                <a href="/dapur-imajinasi/ruangredaksi" class="btn btn-success btn-sm">Kembali</a>
                <a href="/dapur-imajinasi/ruangredaksi/profil/{{ auth()->user()->username }}/edit"
                    class="btn btn-warning btn-sm">Edit</a>
                <a href="/dapur-imajinasi/ruangredaksi/profil/editpassword/{{ auth()->user()->id }}/edit" target="_blank"
                    class="btn btn-danger btn-sm">Ubah
                    Password</a>
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
                                    <td>{{ auth()->user()->name }}</td>
                                </tr>
                                <tr>
                                    <th>Username</th>
                                    <td>{{ auth()->user()->username }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ auth()->user()->email }}</td>
                                </tr>
                                <tr>
                                    <th>No. HP</th>
                                    <td>0{{ auth()->user()->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>{{ auth()->user()->address }}</td>
                                </tr>
                                <tr>
                                    <th>Otorisasi</th>
                                    <td>{{ auth()->user()->roleadmin->role }}</td>
                                </tr>
                            </tbody>
                            </thead>
                        </table>
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
