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
                    <a href="/dapur-imajinasi/ruangredaksi/artikel" class="btn bg-success btn-sm"><i
                            class="fas fa-arrow-left nav-icon"></i> Kembali</a>
                    <a href="/dapur-imajinasi/ruangredaksi/artikel/create" class="btn btn-primary btn-sm"><i
                            class="fas fa-file-pen nav-icon"></i> Buat Artikel Baru</a>
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
                                <tr>
                                    <th class="text-center">ID</th>
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
                                            <td>{{ $artikel->category->name }}</td>
                                            <td>{{ $artikel->author->name }}</td>
                                            <td>{{ $artikel->user->name }}</td>
                                            <td>
                                                <?php if ($artikel->status == '1') {
                                                    echo 'Publish';
                                                } ?>
                                            </td>
                                            <td>{{ $artikel->published_at->translatedFormat('l, d M Y - H:i:s') }} WIB</td>
                                            <td>
                                                <a href="/artikel/rlo-{{ $artikel->id }}/{{ $artikel->slug }}"
                                                    target="_blank" class="btn btn-sm bg-info"><i
                                                        class="fa-solid fa-eye"></i></a>
                                                {{-- <a href="/dapur-imajinasi/ruangredaksi/artikel/{{ $artikel->slug }}" target="_blank"
                                                class="badge bg-info"><i class="fa-solid fa-eye"></i></a> --}}
                                                <a href="/dapur-imajinasi/ruangredaksi/artikel/{{ $artikel->slug }}/edit"
                                                    class="btn btn-sm bg-warning"><i class="fa-solid fa-edit"></i></a>
                                                <form action="/dapur-imajinasi/ruangredaksi/artikel/{{ $artikel->slug }}"
                                                    method="post" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-sm bg-danger"
                                                        onclick="return confirm('Yakin mau hapus artikel {{ $artikel->title }}?')"><i
                                                            class="fa-solid fa-trash"></i></button>
                                                </form>
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
