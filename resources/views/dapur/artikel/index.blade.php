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
                    <a href="/dapur-imajinasi/ruangredaksi/artikel/create" class="btn bg-primary btn-sm"><i
                            class="fas fa-file-pen nav-icon"></i> Buat Artikel</a>
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
                        <h3 class="card-title mt-2">Artikel</h3>

                        <div class="card-tools my-2">
                            <form class="form-inline" action="/dapur-imajinasi/ruangredaksi/cari-artikel">
                                <div class="input-group input-group-sm" style="width: 200px;">
                                    <input type="text" name="search" class="form-control float-right"
                                        placeholder="Cari Artikel" aria-label="cari" value="{{ request('search') }}">

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
                                                } ?>
                                            </td>
                                            <td class="text-center">
                                                {{ $artikel->published_at->translatedFormat('l, d M Y - H:i:s') }} WIB</td>
                                            <td class="text-center">
                                                <a href="/artikel/rlo-{{ $artikel->id }}/{{ $artikel->slug }}"
                                                    target="_blank" class="btn btn-sm bg-info"><i
                                                        class="fa-solid fa-eye"></i> Tampil</a>
                                                {{-- <a href="/dapur-imajinasi/ruangredaksi/artikel/{{ $artikel->slug }}" target="_blank"
                                                class="badge bg-info"><i class="fa-solid fa-eye"></i></a> --}}
                                                @canany(['SuperAdmin', 'Admin', 'Editor'])
                                                    <a href="/dapur-imajinasi/ruangredaksi/artikel/{{ $artikel->slug }}/edit"
                                                        class="btn btn-sm bg-warning"><i class="fa-solid fa-edit"></i> Edit</a>
                                                @endcanany
                                                @canany(['SuperAdmin'])
                                                    <form action="/dapur-imajinasi/ruangredaksi/artikel/{{ $artikel->slug }}"
                                                        method="post" class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="btn btn-sm bg-danger"
                                                            onclick="return confirm('Yakin mau hapus artikel {{ $artikel->title }}?')"><i
                                                                class="fa-solid fa-trash"></i> Hapus</button>
                                                    </form>
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
