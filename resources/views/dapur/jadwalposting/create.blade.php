@extends('dapur.layouts.main')

@section('container')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="text-center">
                    <h4>Buat Artikel Baru</h4>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="my-3 mx-3">
            <form method="post" action="/dapur-imajinasi/ruangredaksi/jadwalposting" enctype="multipart/form-data">
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
                <div class="mb-3">
                    <label for="category" class="form-label">Kategori</label>
                    <select class="form-control kategori @error('category_id') is-invalid @enderror" name="category_id">
                        {{-- <option>--- Pilih Kategori ---</option> --}}
                        @foreach ($categories as $kategori)
                            <option value="{{ old('category_id', $kategori->id) }}">{{ $kategori->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">
                            Kategori belum dipilih
                        </div>
                    @enderror
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

                <div class="mb-3">
                    <label for="tanggal">Tanggal Publish</label>
                    <input type="datetime-local" class="form-control @error('published_at') is-invalid @enderror"
                        id="published_at" name="published_at" value="{{ now() }}" />
                    @error('published_at')
                        <div class="invalid-feedback">
                            Tanggal belum diisi
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tags" class="form-label">Tag</label>
                    @include('dapur.jadwalposting.tags')
                </div>
                <div class="mb-3">
                    <label for="longtail" class="form-label">Longtail Keyword</label>
                    @include('dapur.jadwalposting.longtailkeywords')
                </div>

                <div class="mb-3">
                    <label for="user" class="form-label">Penulis</label>
                    <select class="form-control penulis" name="author_id">
                        @foreach ($users as $author)
                            @if (old('author_id', $author->name) == auth()->user()->name)
                                <option value="{{ $author->id }}" selected>{{ $author->name }}</option>
                            @else
                                <option value="{{ $author->id }}">{{ $author->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="user" class="form-label">Editor</label>
                    <select class="form-control editor" name="user_id">
                        @foreach ($editors as $editor)
                            @if (old('user_id', $editor->name) == auth()->user()->name)
                                <option value="{{ $editor->id }}" selected>{{ $editor->name }}</option>
                            @else
                                <option value="{{ $editor->id }}">{{ $editor->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="sumber" class="form-label">Sumber Artikel</label>
                    <input type="text" class="form-control" id="sumber" name="sumber" value="{{ old('sumber') }}">
                </div>

                @canany(['SuperAdmin', 'Admin', 'Editor'])
                    <div class="mb-3">
                        <label for="headline" class="form-label">Headline</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="headline" id="headline1" value="1">
                            <label class="form-check-label" for="headline1">
                                Headline Yes
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="headline" id="headline2" value="0"
                                checked>
                            <label class="form-check-label" for="headline2">
                                Headline No
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="pilihan" class="form-label">Pilihan Editor</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="pilihan" id="pilihan1" value="1">
                            <label class="form-check-label" for="pilihan1">
                                Pilihan Editor Yes
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="pilihan" id="pilihan2" value="0"
                                checked>
                            <label class="form-check-label" for="pilihan2">
                                Pilihan Editor No
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="rekomendasi" class="form-label">Rekomendasi</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="rekomendasi" id="rekomendasi1"
                                value="1">
                            <label class="form-check-label" for="rekomendasi1">
                                Rekomendasi Yes
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="rekomendasi" id="rekomendasi2"
                                value="0" checked>
                            <label class="form-check-label" for="rekomendasi2">
                                Rekomendasi No
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="status1" value="1">
                            <label class="form-check-label" for="status1">
                                Publish Yes
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="status2" value="0"
                                checked>
                            <label class="form-check-label" for="status2">
                                Publish No <strong>(Masuk ke konsep)</strong>
                            </label>
                        </div>
                    </div>
                @endcanany

                <!-- Gambar -->
                <div class="my-3">
                    <label for="image" class="form-label">Gambar Artikel</label>
                    <div id="holder" class="img-preview img-fluid mb-1 col-sm-3 d-block"></div>
                    <div><small style="color: blue">Gambar maksimal 200 kb (jpg,jpeg,png)</small></div>
                    <div class="input-group mt-1">
                        <span class="input-group-btn">
                            <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                <i class="fa fa-picture-o"></i> Upload/Pilih Gambar
                            </a>
                        </span>
                        <input class="form-control @error('image') is-invalid @enderror" type="text" id="thumbnail"
                            name="image" hidden>
                        @error('image')
                            <div class="invalid-feedback">
                                Gambar belum dimasukkan / Ukuran gambar terlalu besar
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label>Kompres Gambar: <a href="https://squoosh.app" target="_blank"
                            class="text-decoration-none">DISINI</a></label>
                </div>

                <div class="mb-3">
                    <label for="caption" class="form-label">Caption</label>
                    <input type="text" class="form-control @error('caption') is-invalid @enderror" id="caption"
                        name="caption" value="{{ old('caption') }}">
                    @error('caption')
                        <div class="invalid-feedback">
                            Caption belum dibuat
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="credit" class="form-label">Fotografer / Kredit Foto</label>
                    <input type="text" class="form-control @error('credit') is-invalid @enderror" id="credit"
                        name="credit" value="{{ old('credit') }}">
                    @error('credit')
                        <div class="invalid-feedback">
                            Nama fotografer / kredit foto belum diisi
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success my-5">Buat Artikel</button>
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
            fetch("/dapur-imajinasi/ruangredaksi/jadwalSlug?title=" + title.value)
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

    <!-- tag -->
    <script>
        $('input[name="longtail"]').amsifySuggestags();
    </script>
    <script src="{{ asset('assets') }}/plugins/tag/jquery.amsify.suggestags.js"></script>


    <script>
        $(document).ready(function() {
            $(".kategori").select2({
                theme: "classic"
            });
        });
        $(document).ready(function() {
            $(".penulis").select2({
                theme: "classic"
            });
        });
        $(document).ready(function() {
            $(".editor").select2({
                theme: "classic"
            });
        });
    </script>
@endsection
