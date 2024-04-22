@extends('dapur.layouts.main')

@section('container')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="text-center">
                    <h4>Edit Tag</h4>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="my-3 mx-3">
            <form method="post" action="/dapur-imajinasi/ruangredaksi/tag/{{ $tag->slug }}" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Tag</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name', $tag->name) }}">
                    @error('name')
                        <div class="invalid-feedback">
                            Nama Tag belum diisi
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                        name="slug" value="{{ old('slug', $tag->slug) }}">
                    @error('slug')
                        <div class="invalid-feedback">
                            Slug harus diisi atau otomatis terisi setelah membuat nama Tag
                        </div>
                    @enderror
                    <small style="color: blue">Slug SEO Otomatis</small>
                </div>
                <button type="submit" class="btn btn-success my-5">Edit Tag</button>
            </form>
        </div>
    </section>
    <!-- /.content -->

    <!-- slug otomatis -->
    {{-- <script>
        const name = document.querySelector("#name");
        const slug = document.querySelector("#slug");

        name.addEventListener("keyup", function() {
            let preslug = name.value;
            preslug = preslug.replace(/ /g, "-");
            slug.value = preslug.toLowerCase();
        });
    </script> --}}
    <script>
        const name = document.querySelector("#name");
        const slug = document.querySelector("#slug");

        name.addEventListener("keyup", function() {
            fetch("/dapur-imajinasi/ruangredaksi/tagSlug?name=" + name.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        });
    </script>
@endsection
