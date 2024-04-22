@extends('dapur.layouts.main')

@section('container')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="text-center">
                    <h4 class="fw-bolder">TAMBAH FOTO BARU</h4>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="my-3 mx-3">
            <form method="post" action="/dapur-imajinasi/ruangredaksi/image" enctype="multipart/form-data">
                @csrf
                <!-- Judul -->
                <div class="mb-3">
                    <label for="name" class="form-label">Judul</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" maxlength="110" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">
                            Judulnya belum dibuat
                        </div>
                    @enderror
                    <small style="color: blue">Maksimal 110
                        Karakter</small>
                </div>
                <!-- Slug -->
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
                <!-- Caption -->
                <div class="mb-3">
                    <label for="caption" class="form-label">Caption</label>
                    <input type="text" class="form-control @error('caption') is-invalid @enderror" id="caption"
                        name="caption" value="{{ old('caption') }}">
                    @error('caption')
                        <div class="invalid-feedback">
                            Caption belum diisi
                        </div>
                    @enderror
                </div>
                <!-- Isi Konten -->
                <div class="mb-3">
                    <label for="body" class="form-label">Isi Konten</label>
                    <div>
                        <textarea id="body" name="body" class="form-control" value="{{ old('body') }}"></textarea>
                    </div>
                    @error('body')
                        <div class="" style="font-size: .875em; color: #b02a37">
                            Konten belum diisi
                        </div>
                    @enderror
                </div>
                <!-- Penulis -->
                <div class="mb-3">
                    <label for="user" class="form-label">Penulis</label>
                    <select class="form-control editor" name="user_id">
                        @foreach ($users as $editor)
                            @if (old('user_id', $editor->name) == auth()->user()->name)
                                <option value="{{ $editor->id }}" selected>{{ $editor->name }}</option>
                            @else
                                <option value="{{ $editor->id }}">{{ $editor->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <!-- Kredit Foto -->
                <div class="mb-3">
                    <label for="sumber" class="form-label">Sumber/Kredit Foto</label>
                    <input type="text" class="form-control @error('sumber') is-invalid @enderror" id="sumber"
                        name="sumber" value="{{ old('sumber') }}">
                    @error('sumber')
                        <div class="invalid-feedback">
                            Sumber/Kredit Foto belum diisi
                        </div>
                    @enderror
                </div>


                <!-- Gambar -->
                <div class="my-3">
                    <label for="image" class="form-label">Foto</label>
                    <div id="holder" class="img-preview img-fluid mb-1 col-sm-3 d-block"></div>
                    <div><small style="color: blue">Foto maksimal 200 kb (jpg,jpeg,png)</small></div>
                    <div class="input-group mt-1">
                        <span class="input-group-btn">
                            <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                <i class="fa fa-picture-o"></i> Upload/Pilih Foto
                            </a>
                        </span>
                        <input class="form-control @error('image') is-invalid @enderror" type="text" id="thumbnail"
                            name="image" hidden>
                        @error('image')
                            <div class="invalid-feedback">
                                Foto belum dimasukkan / Ukuran foto terlalu besar
                            </div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-success my-5">Tambah Foto</button>
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
            fetch("/dapur-imajinasi/ruangredaksi/imageSlug?name=" + name.value)
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


    <script>
        $(document).ready(function() {
            $(".editor").select2({
                theme: "classic"
            });
        });
    </script>
@endsection
