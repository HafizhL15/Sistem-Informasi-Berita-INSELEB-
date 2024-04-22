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
                    <a href="/dapur-imajinasi/ruangredaksi/iklan/create" class="btn btn-primary btn-sm">
                        Buat Iklan</a>
                    <a href="/dapur-imajinasi/ruangredaksi/iklan/restore" class="btn btn-success btn-sm"><i
                            class="fas fa-arrows-rotate"></i>
                        Restore All</a>
                    <a href="/dapur-imajinasi/ruangredaksi/iklan/delete/" class="btn btn-danger btn-sm"><i
                            class="fas fa-trash" onclick="return confirm('Yakin mau hapus permanen semua iklan?')"></i>
                        Delete All</a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-12 mt-1
            ">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title mt-2">Iklan</h3>

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
                                    <th>Nama</th>
                                    <th>Posisi</th>
                                    <th>Status</th>
                                    <th>Tgl. Dihapus</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 14px">
                                @if ($ads->count())
                                    @foreach ($ads as $iklan)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $iklan->name }}</td>
                                            <td class="text-center">{{ $iklan->positionads->name }}</td>
                                            <td class="text-center">
                                                <?php if ($iklan->status == '1') {
                                                    echo 'Tampil';
                                                } else {
                                                    echo 'Tidak Tampil';
                                                }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                {{ $iklan->deleted_at->translatedFormat('l, d M Y - H:i') }} WIB</td>
                                            <td class="text-center">
                                                <a href="/dapur-imajinasi/ruangredaksi/iklan/restore/{{ $iklan->id }}"
                                                    class="btn btn-sm bg-success text-decoration-none"><i
                                                        class="fas fa-arrows-rotate"></i> Kembalikan</a>
                                                <a href="/dapur-imajinasi/ruangredaksi/iklan/delete/{{ $iklan->id }}"
                                                    class="btn btn-sm bg-danger text-decoration-none"><i
                                                        class="fas fa-trash"
                                                        onclick="return confirm('Yakin mau hapus permanen iklan {{ $iklan->name }}?')"></i>
                                                    Hapus Permanen</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="7">Tidak ada data yang ditemukan</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="mx-3 mt-3">
                        {{ $ads->links() }}
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
