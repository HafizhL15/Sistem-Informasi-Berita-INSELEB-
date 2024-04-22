@extends('dapur.layouts.main')

@section('container')
    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="text-center my-3">
                <h4 class="fw-bolder">DATA CALON PENULIS</h4>
            </div>
        </div>
        <div class="row justify-content-center mx-1">
            <div class="col-md-6 my-3 bg-white rounded">
                <h1 class="my-3">{{ $calon->name }}</h1>
                <div class="mb-3">
                    @if ($calon->image)
                        <img src="{{ asset('storage/' . $calon->image) }}" alt="{{ $calon->name }}"
                            class="me-2 mt-1 img-fluid">
                    @else
                        <img src="{{ asset('img') }}/content.jpg" alt="{{ $calon->name }}" class="me-2 mt-1 img-fluid">
                    @endif
                </div>

                <table class="table text-nowrap">
                    <tbody>
                        <tr>
                            <th>Email</th>
                            <td>: {{ $calon->email }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>: {{ $calon->address }}</td>
                        </tr>
                        <tr>
                            <th>WhatsApp</th>
                            <td>: 0{{ $calon->phone }}</td>
                        </tr>
                        <tr>
                            <th>Website</th>
                            <td>: {{ $calon->web }}</td>
                        </tr>
                        <tr>
                            <th>Facebook</th>
                            <td>: {{ $calon->facebook }}</td>
                        </tr>
                        <tr>
                            <th>Twitter</th>
                            <td>: {{ $calon->twitter }}</td>
                        </tr>
                        <tr>
                            <th>Instagram</th>
                            <td>: {{ $calon->instagram }}</td>
                        </tr>
                        <tr>
                            <th>Youtube</th>
                            <td>: {{ $calon->youtube }}</td>
                        </tr>
                        <tr>
                            <th>TikTok</th>
                            <td>: {{ $calon->tiktok }}</td>
                        </tr>
                        <tr>
                            <th>Linkedin</th>
                            <td>: {{ $calon->linkedin }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6 my-3 mx-3">
                <a href="/dapur-imajinasi/ruangredaksi/pendaftar" class="btn btn-success">Kembali</a>
            </div>
        </div>

    </section>
    <!-- /.content -->
@endsection
