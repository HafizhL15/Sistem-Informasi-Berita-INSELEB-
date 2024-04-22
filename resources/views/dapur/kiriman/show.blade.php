@extends('dapur.layouts.main')

@section('container')
    <!-- Main content -->
    <section class="content">
        <div class="row mb-5">
        </div>
        <div class="container">
            <div class="row justify-content-center">

                <div class="row bg-white rounded">
                    <div class="my-3">
                        <h3 class="mb-3">Judul: {{ $kirimanpembaca->title }}</h3>
                        <p>Nama Pengirim: <strong class="text-uppercase">{{ $kirimanpembaca->namapengirim }}</strong></p>

                        @if ($kirimanpembaca->image)
                            <img src="{{ asset('storage/' . $kirimanpembaca->image) }}" alt="{{ $kirimanpembaca->title }}"
                                class="me-2 mt-1 img-fluid mb-3" style="max-width: 360px">
                        @else
                            <img src="{{ asset('img') }}/content.jpg" alt="{{ $kirimanpembaca->title }}"
                                class="me-2 mt-1 img-fluid mb-3" style="max-width: 360px">
                        @endif
                        <p>Deskripsi: {{ $kirimanpembaca->description }}</p>
                        <article class="my-3 fs-5">
                            {!! $kirimanpembaca->body !!}
                        </article>
                        <p>Sumber: <strong>{{ $kirimanpembaca->sumber }}</strong></p>
                    </div>
                </div>
                <div class="my-3">
                    <a href="/dapur-imajinasi/ruangredaksi/kirimanpembaca" class="btn btn-success">Kembali</a>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
@endsection
