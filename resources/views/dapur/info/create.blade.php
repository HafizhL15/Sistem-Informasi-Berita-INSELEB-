@extends('dapur.layouts.main')

@section('container')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="text-center">
                    <h4>Buat Info Baru</h4>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="my-3 mx-3">
            <form method="post" action="/dapur-imajinasi/ruangredaksi/info" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Judul</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        name="title" maxlength="110" value="{{ old('title') }}">
                    @error('title')
                        <div class="invalid-feedback">
                            Judulnya belum dibuat
                        </div>
                    @enderror
                    <small style="color: blue">Maksimal 110
                        Karakter</small>
                </div>
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                        name="slug" value="{{ old('slug') }}">
                    @error('slug')
                        <div class="invalid-feedback">
                            Slug harus diisi atau otomatis terisi setelah membuat judul
                        </div>
                    @enderror
                    <small style="color: blue">Slug SEO Otomatis</small>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <input type="text" class="form-control @error('description') is-invalid @enderror" id="description"
                        name="description" maxlength="170" value="{{ old('description') }}">
                    @error('description')
                        <div class="invalid-feedback">
                            Deskripsi belum diisi
                        </div>
                    @enderror
                    <small style="color: blue">Maksimal 170
                        Karakter</small>
                </div>

                <!-- Isi Artikel -->
                <div class="mb-3">
                    <label for="body" class="form-label">Isi Artikel</label>
                    <div>
                        <textarea id="body" name="body" rows="20" class="my-editor form-control" value="{{ old('body') }}"></textarea>
                    </div>
                    @error('body')
                        <div class="" style="font-size: .875em; color: #b02a37">
                            Konten belum diisi
                        </div>
                    @enderror
                </div>

                <div class="my-3">
                    <label for="image" class="form-label">Gambar Info</label>
                    <img class="img-preview img-fluid mb-3 col-sm-3">
                    <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                        name="image" onchange="previewImage()">
                    @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <small style="color: blue">Gambar maksimal 200 kb (jpg,jpeg,png)</small>
                </div>
                <button type="submit" class="btn btn-success my-5">Buat Info</button>
            </form>
        </div>
    </section>
    <!-- /.content -->

    <!-- slug otomatis -->
    {{-- <script>
        const title = document.querySelector("#title");
        const slug = document.querySelector("#slug");

        title.addEventListener("keyup", function() {
            let preslug = title.value;
            preslug = preslug.replace(/ /g, "-");
            slug.value = preslug.toLowerCase();
        });
    </script> --}}

    <script>
        const title = document.querySelector("#title");
        const slug = document.querySelector("#slug");

        title.addEventListener("keyup", function() {
            fetch("/dapur-imajinasi/ruangredaksi/infoSlug?title=" + title.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        });
    </script>

    <!-- IMG Preview -->
    <script>
        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
