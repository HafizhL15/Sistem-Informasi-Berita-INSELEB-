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
                    <a href="/dapur-imajinasi/ruangredaksi/artikel/create" class="btn btn-primary btn-sm"><i
                            class="fas fa-file-pen nav-icon"></i> Buat Artikel</a>

                    @canany(['SuperAdmin', 'Admin'])
                        <a href="/dapur-imajinasi/ruangredaksi/artikel/restore" class="btn btn-success btn-sm"><i
                                class="fas fa-arrows-rotate"></i>
                            Restore All</a>
                        <a href="/dapur-imajinasi/ruangredaksi/artikel/delete/" class="btn btn-danger btn-sm"><i
                                class="fas fa-trash" onclick="return confirm('Yakin mau hapus permanen semua artikel?')"></i>
                            Delete All</a>
                    @endcanany

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
                        <h3 class="card-title mt-2">Artikel Terhapus</h3>
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
                                    <th>ID</th>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Penulis</th>
                                    <th>Editor</th>
                                    <th>Status</th>
                                    <th>Tanggal Publish</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 14px">
                                @if ($artikels->count())
                                    @foreach ($artikels as $artikel)
                                        <tr>
                                            <td class="text-center">{{ $artikel->id }}</td>
                                            <td>{{ $artikel->title }}</td>
                                            <td class="text-center">{{ $artikel->category->name }}</td>
                                            <td class="text-center">{{ $artikel->author->name }}</td>
                                            <td class="text-center">{{ $artikel->user->name }}</td>
                                            <td class="text-center">
                                                <?php if ($artikel->status == '1') {
                                                    echo 'Publish';
                                                } else {
                                                    echo 'Belum Publish';
                                                } ?>
                                            </td>
                                            <td class="text-center">
                                                {{ $artikel->deleted_at->translatedFormat('l, d M Y - H:i') }} WIB</td>
                                            <td class="text-center">
                                                @canany(['SuperAdmin'])
                                                    <a href="/dapur-imajinasi/ruangredaksi/artikel/restore/{{ $artikel->id }}"
                                                        class="btn btn-sm bg-success text-decoration-none"><i
                                                            class="fas fa-arrows-rotate"></i> Kembalikan</a>
                                                    <a href="/dapur-imajinasi/ruangredaksi/artikel/delete/{{ $artikel->id }}"
                                                        class="btn btn-sm bg-danger text-decoration-none"><i
                                                            class="fas fa-trash"
                                                            onclick="return confirm('Yakin mau hapus permanen artikel {{ $artikel->name }}?')"></i>
                                                        Hapus Permanen</a>
                                                @endcanany
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="8">Tidak ada data yang ditemukan</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="mx-3 mt-3">
                        {{ $artikels->links() }}
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
