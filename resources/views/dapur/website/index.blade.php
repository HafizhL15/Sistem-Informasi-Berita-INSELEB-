@extends('dapur.layouts.main')

@section('container')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="text-center mt-1">
                    <h4 class="fw-bolder">PROFIL SITUS</h4>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-12 mt-2">
                <div class="card mx-1">
                    <div class="card-body table-responsive p-0">
                        <table class="table text-nowrap">
                            <thead>
                            <tbody>
                                @foreach ($websites as $website)
                                    <tr>
                                        <th>Nama Situs</th>
                                        <td>{{ $website->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Domain</th>
                                        <td>{{ $website->domain }}</td>
                                    </tr>
                                    <tr>
                                        <th>Slogan</th>
                                        <td>{{ $website->slogan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Deskripsi</th>
                                        <td>{{ $website->description }}</td>
                                    </tr>
                                    <tr>
                                        <th>Meta Title</th>
                                        <td>{{ $website->meta_title }}</td>
                                    </tr>
                                    <tr>
                                        <th>Meta Deskripsi</th>
                                        <td>{{ $website->meta_description }}</td>
                                    </tr>
                                    <tr>
                                        <th>Meta Keyword</th>
                                        <td>{{ $website->meta_keyword }}</td>
                                    </tr>
                                    <tr>
                                        <th>Logo</th>
                                        <td>
                                            @if ($website->image)
                                                <img src="{{ asset('storage/' . $website->image) }}"
                                                    alt="{{ $website->name }}" class="img-fluid my-1">
                                            @else
                                                <img src="{{ asset('img') }}/logo-default.jpg" alt="{{ $website->name }}"
                                                    class="img-fluid my-1">
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Icon</th>
                                        <td>
                                            @if ($website->icon)
                                                <img src="{{ asset('storage/' . $website->icon) }}"
                                                    alt="{{ $website->name }}"
                                                    class="img-size-50 img-fluid img-circle my-1">
                                            @else
                                                <img src="{{ asset('img') }}/icon-default.png" alt="{{ $website->name }}"
                                                    class="img-size-50 img-fluid img-circle my-1">
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Facebook</th>
                                        <td>{{ $website->facebook }}</td>
                                    </tr>
                                    <tr>
                                        <th>twitter</th>
                                        <td>{{ $website->twitter }}</td>
                                    </tr>
                                    <tr>
                                        <th>instagram</th>
                                        <td>{{ $website->instagram }}</td>
                                    </tr>
                                    <tr>
                                        <th>Youtube</th>
                                        <td>{{ $website->youtube }}</td>
                                    </tr>
                                    <tr>
                                        <th>TikTok</th>
                                        <td>{{ $website->tiktok }}</td>
                                    </tr>
                                    <tr>
                                        <td><a href="/dapur-imajinasi/ruangredaksi/website/{{ $website->slug }}/edit"
                                                class="btn btn-warning my-3">Edit</a></td>
                                    </tr>
                                @endforeach
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
