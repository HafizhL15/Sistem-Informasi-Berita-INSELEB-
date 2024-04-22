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
                    <a href="/dapur-imajinasi/ruangredaksi/tag/create" class="btn btn-primary btn-sm">
                        Buat Tag Baru</a>
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
                        <h3 class="card-title mt-2">Tag</h3>

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
                                    <th>No</th>
                                    <th>Nama Tag</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 14px">
                                @if ($tags->count())
                                    @foreach ($tags as $tag)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-uppercase">{{ $tag->name }}</td>
                                            <td class="text-center">
                                                {{-- <a href="/dapur-imajinasi/ruangredaksi/tag/{{ $tag->slug }}" target="_blank"
                                                    class="badge bg-info"><i class="fa-solid fa-eye"></i></a> --}}
                                                <a href="/dapur-imajinasi/ruangredaksi/tag/{{ $tag->slug }}/edit"
                                                    class="btn btn-sm bg-warning"><i class="fa-solid fa-edit"></i> Edit</a>
                                                <form action="/dapur-imajinasi/ruangredaksi/tag/{{ $tag->slug }}"
                                                    method="post" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-sm bg-danger"
                                                        onclick="return confirm('Yakin mau hapus tag {{ $tag->name }}?')"><i
                                                            class="fa-solid fa-trash"></i> Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="4">Tidak ada data yang ditemukan</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <div class="mx-3 mt-3">
                            {{ $tags->links() }}
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
