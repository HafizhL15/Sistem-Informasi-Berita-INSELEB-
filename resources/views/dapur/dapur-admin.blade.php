@extends('dapur.layouts.main')

@section('container')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="text-center mt-3">
                    @if (auth()->user()->image)
                        <img src="{{ asset('storage/' . auth()->user()->image) }}" alt="{{ auth()->user()->name }}"
                            class="brand-image rounded-circle my-1 elevation-2 mr-3"
                            style="height: 180px; width: 180px;  object-fit: cover">
                    @else
                        <img src="{{ asset('img') }}/avatar.png" alt="{{ auth()->user()->name }}"
                            class="brand-image img-size-64 img-fluid img-circle my-1">
                    @endif
                </div>
                <div class="container">
                    <h5 class="mt-3 mb-1 text-center fw-bolder">{{ auth()->user()->name }}</h5>
                    <h6 class="mt-1 mb-5 text-center fw-bolder">Status :
                        <a href="/dapur-imajinasi/ruangredaksi/profil/{{ auth()->user()->username }}" target="_blank"
                            class="text-decoration-none text-danger">{{ $rolenavbar }}</a>
                    </h6>
                    <hr>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>



    <!-- Main content -->
    <section class="content">

        <div class="row mx-2">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $artikel }}</h3>

                        <p>Total Artikel</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-folder"></i>
                    </div>
                    <a href="/dapur-imajinasi/ruangredaksi/artikel" class="small-box-footer">Lihat
                        Artikel <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $kategori }}</h3>

                        <p>Total Kategori</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-box-archive"></i>
                    </div>
                    <a href="/dapur-imajinasi/ruangredaksi/kategori" class="small-box-footer">Lihat
                        Kategori <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $iklan }}</h3>

                        <p>Total Iklan</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-rectangle-ad"></i>
                    </div>
                    <a href="/dapur-imajinasi/ruangredaksi/iklan" class="small-box-footer">Lihat Iklan <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $user }}</h3>

                        <p>Total User</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-group"></i>
                    </div>
                    <a href="/dapur-imajinasi/ruangredaksi/useradmin" class="small-box-footer">Lihat User <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
    </section>
    <!-- /.content -->

    @include('sweetalert::alert')
@endsection
