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
                <div class="col-sm-6">
                    <a href="/dapur-imajinasi/ruangredaksi/useradmin/create" class="btn btn-primary btn-sm"> Buat User</a>
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
                        <h3 class="card-title mt-2">User Admin</h3>

                        <div class="card-tools my-2">
                            <form class="form-inline" action="/dapur-imajinasi/ruangredaksi/cari-user">
                                <div class="input-group input-group-sm" style="width: 200px;">
                                    <input type="text" name="search" class="form-control float-right"
                                        placeholder="Cari User" aria-label="cari" value="{{ request('search') }}">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr class="text-center">
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Otorisasi</th>
                                    <th>Tgl. Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 14px">
                                @if ($users->count())
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="text-uppercase">{{ $user->name }}</td>
                                            <td class="text-center">{{ $user->username }}</td>
                                            <td class="text-center">{{ $user->email }}</td>
                                            <td class="text-center">{{ $user->roleadmin->role }}</td>
                                            <td class="text-center">
                                                {{ $user->created_at->translatedFormat('l, d M Y - H:i') }} WIB</td>
                                            <td class="text-center">
                                                <a href="/dapur-imajinasi/ruangredaksi/useradmin/{{ $user->id }}"
                                                    target="_blank" class="btn btn-sm bg-info"><i
                                                        class="fa-solid fa-eye"></i> Lihat</a>
                                                <a href="/dapur-imajinasi/ruangredaksi/useradmin/{{ $user->id }}/edit"
                                                    class="btn btn-sm bg-warning"><i class="fa-solid fa-edit"></i> Edit</a>
                                                <form action="/dapur-imajinasi/ruangredaksi/useradmin/{{ $user->id }}"
                                                    method="post" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-sm bg-danger border-0"
                                                        onclick="return confirm('Yakin mau hapus user {{ $user->name }}?')"><i
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
                            {{ $users->links() }}
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
