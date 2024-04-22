@extends('dapur.layouts.main')

@section('container')
    <!-- Main content -->
    <section class="content">

        <div class="container">
            <div class="row justify-content-center">
                <div class="my-3 mx-3">
                    <h1 class="mb-1">Kategori : {{ $kategori->name }}</h1>
                    @if ($kategori->image)
                        <img src="{{ asset('storage/' . $kategori->image) }}" alt="{{ $kategori->name }}"
                            class="me-2 mt-3 img-fluid">
                    @else
                        <img src="{{ asset('img') }}/content.jpg" alt="{{ $kategori->name }}" class="me-2 mt-3 img-fluid">
                    @endif
                    <article class="my-3 fs-5">
                        {!! $kategori->description !!}
                    </article>
                </div>
                <div class="my-3">
                    <a href="/dapur-imajinasi/ruangredaksi/kategori" class="btn btn-success">Kembali</a>
                    <a href="/dapur-imajinasi/ruangredaksi/kategori/{{ $kategori->slug }}/edit"
                        class="btn btn-warning">Edit</a>
                    <form action="/dapur-imajinasi/ruangredaksi/kategori/{{ $kategori->slug }}" method="post"
                        class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger" onclick="return confirm('Yakin mau hapus Kategori?')">Hapus</button>
                    </form>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
@endsection
