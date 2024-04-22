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
                    <a href="/dapur-imajinasi/ruangredaksi/image/create" class="btn btn-primary btn-sm">
                        Tambah Foto</a>
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
                        <h3 class="card-title mt-2">Daftar Foto / Gambar</h3>

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
                        @if ($images->count())
                            <div class="card-group my-3 mx-3">
                                @foreach ($images as $image)
                                    <div class="card">
                                        <img src="{{ $image->image }}" alt="{{ $image->name }}" class="gambar-dsb">
                                        <div class="card-body fw-bold">
                                            <p>{{ $image->name }}
                                            </p>
                                        </div>
                                        <div class="card-footer">
                                            <a href="/foto/rlo-{{ $image->id }}/{{ $image->slug }}" target="_blank"
                                                class="btn btn-sm bg-info"><i class="fa-solid fa-eye"></i> Tampil</a>
                                            <a href="/dapur-imajinasi/ruangredaksi/image/{{ $image->slug }}/edit"
                                                class="btn btn-sm bg-warning"><i class="fa-solid fa-edit"></i> Edit</a>
                                            <form action="/dapur-imajinasi/ruangredaksi/image/{{ $image->slug }}"
                                                method="post" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-sm bg-danger"
                                                    onclick="return confirm('Yakin mau hapus gambar {{ $image->name }}?')"><i
                                                        class="fa-solid fa-trash"></i> Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center mt-3">
                                Tidak ada data yang ditemukan
                            </div>
                        @endif
                    </div>
                    <div class="mx-3 mt-3">
                        {{ $images->links() }}
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
