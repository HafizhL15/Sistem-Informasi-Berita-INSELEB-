@extends('dapur.layouts.main')

@section('container')
    <!-- Main content -->
    <section class="content">

        <div class="container">
            <div class="row justify-content-center">
                <div class="my-3 mx-3">
                    <h1 class="mb-3">{{ $artikel->title }}</h1>
                    <p>Editor: <strong>{{ $artikel->user->name }}</strong>
                        <br>
                        Penulis: <strong>{{ $artikel->author->name }}</strong>
                        <br>
                        Kategori: <strong>
                            {{ $artikel->category->name }}</strong>
                    </p>
                    @if ($artikel->image)
                        <img src="{{ $artikel->image }}" alt="{{ $artikel->category->name }}"
                            class="me-2 mt-1 img-fluid">
                    @else
                        <img src="{{ asset('img') }}/content.jpg" alt="{{ $artikel->category->name }}"
                            class="me-2 mt-1 img-fluid">
                    @endif
                    <article class="my-3 fs-5">
                        {!! $artikel->body !!}
                    </article>
                </div>
                <div class="my-3">
                    <a href="/dapur-imajinasi/ruangredaksi/konsep" class="btn btn-success">Kembali</a>
                    <a href="/dapur-imajinasi/ruangredaksi/konsep/{{ $artikel->slug }}/edit"
                        class="btn btn-warning">Edit</a>
                    <form action="#" method="post" class="d-inline">
                        <button class="btn btn-danger" onclick="return confirm('Yakin mau hapus artikel?')">Hapus</button>
                    </form>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
@endsection
