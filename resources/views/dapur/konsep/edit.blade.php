@extends('dapur.layouts.main')

@section('container')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="text-center">
                    <h4>Edit Artikel</h4>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="my-3 mx-3">
            <form method="post" action="/dapur-imajinasi/ruangredaksi/konsep/{{ $artikel->slug }}"
                enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Judul</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        name="title" maxlength="110" value="{{ old('title', $artikel->title) }}">
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
                        name="slug" value="{{ old('slug', $artikel->slug) }}">
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
                        name="description" maxlength="170" value="{{ old('description', $artikel->description) }}">
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
                    <select class="form-select kategori @error('category_id') is-invalid @enderror" name="category_id">
                        @foreach ($categories as $category)
                            @if (old('category_id', $artikel->category_id) == $category->id)
                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                            @else
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
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
                        <textarea id="body" name="body" rows="20"
                            class="my-editor form-control @error('body') is-invalid @enderror">{{ old('body', $artikel->body) }}</textarea>
                    </div>
                    @error('body')
                        <div class="invalid-feedback">
                            Konten belum diisi
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tanggal">Tanggal Publish</label>
                    <input type="datetime-local" class="form-control @error('published_at') is-invalid @enderror"
                        id="published_at" name="published_at" value="{{ old('published_at', $artikel->published_at) }}" />
                    @error('published_at')
                        <div class="invalid-feedback">
                            Deskripsi belum diisi
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tag" class="form-label">Tag</label>
                    @include('dapur.konsep.tagedit')
                </div>
                <div class="mb-3">
                    <label for="longtail" class="form-label">Longtail Keyword</label>
                    @include('dapur.konsep.longtailedit')
                </div>

                <div class="mb-3">
                    <label for="author" class="form-label">Penulis</label>
                    <select class="form-select penulis" name="author_id">
                        @foreach ($users as $author)
                            @if (old('author_id', $artikel->author_id) == $author->id)
                                <option value="{{ $author->id }}" selected>{{ $author->name }}</option>
                            @else
                                <option value="{{ $author->id }}">{{ $author->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="editor" class="form-label">Editor</label>
                    <select class="form-select editor" name="user_id">
                        @foreach ($editors as $editor)
                            @if (old('user_id', $artikel->user_id) == $editor->id)
                                <option value="{{ $editor->id }}" selected>{{ $editor->name }}</option>
                            @else
                                <option value="{{ $editor->id }}">{{ $editor->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="sumber" class="form-label">Sumber Artikel</label>
                    <input type="text" class="form-control" id="sumber" name="sumber"
                        value="{{ old('sumber', $artikel->sumber) }}">
                </div>

                @canany(['SuperAdmin', 'Admin', 'Editor'])
                    <div class="mb-3">
                        <label for="headline" class="form-label">Headline</label>
                        <div class="form-check" name="headline" type="radio" id="headline1">
                            <input class="form-check-input" name="headline" value="1" <?php if ($artikel->headline == '1') {
                                echo 'checked';
                            } ?>
                                type="radio" for="headline1">Headline
                            Yes</input>
                        </div>
                        <div class="form-check" name="headline" type="radio" id="headline2">
                            <input class="form-check-input" name="headline" value="0" <?php if ($artikel->headline == '0') {
                                echo 'checked';
                            } ?>
                                type="radio" for="headline2">Headline No</input>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="pilihan" class="form-label">Pilihan Editor</label>
                        <div class="form-check" name="pilihan" type="radio" id="pilihan1">
                            <input class="form-check-input" name="pilihan" value="1" <?php if ($artikel->pilihan == '1') {
                                echo 'checked';
                            } ?> type="radio"
                                for="pilihan1">Pilihan
                            Yes</input>
                        </div>
                        <div class="form-check" name="pilihan" type="radio" id="pilihan2">
                            <input class="form-check-input" name="pilihan" value="0" <?php if ($artikel->pilihan == '0') {
                                echo 'checked';
                            } ?> type="radio"
                                for="pilihan2">Pilihan No</input>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="rekomendasi" class="form-label">Rekomendasi</label>
                        <div class="form-check" name="rekomendasi" type="radio" id="rekomendasi1">
                            <input class="form-check-input" name="rekomendasi" value="1" <?php if ($artikel->rekomendasi == '1') {
                                echo 'checked';
                            } ?>
                                type="radio" for="rekomendasi1">Rekomendasi
                            Yes</input>
                        </div>
                        <div class="form-check" name="rekomendasi" type="radio" id="rekomendasi2">
                            <input class="form-check-input" name="rekomendasi" value="0" <?php if ($artikel->rekomendasi == '0') {
                                echo 'checked';
                            } ?>
                                type="radio" for="rekomendasi2">Rekomendasi No</input>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <div class="form-check" name="status" type="radio" id="status1">
                            <input class="form-check-input" name="status" value="1" <?php if ($artikel->status == '1') {
                                echo 'checked';
                            } ?> type="radio"
                                for="status1">Publish
                            Yes</input>
                        </div>
                        <div class="form-check" name="status" type="radio" id="status2">
                            <input class="form-check-input" name="status" value="0" <?php if ($artikel->status == '0') {
                                echo 'checked';
                            } ?> type="radio"
                                for="status2">Publish No <strong>(Masuk ke konsep)</strong></input>
                        </div>
                    </div>
                @endcanany

                <!-- Gambar -->
                <div class="my-3">
                    <label for="image" class="form-label">Gambar Artikel</label>
                    <div id="holder" class="img-preview d-block">
                        @if ($artikel->image)
                            <img src="{{ $artikel->image }}" class="img-preview img-fluid mb-1 col-sm-3 d-block">
                        @else
                            <img class="img-preview img-fluid mb-3 col-sm-3">
                        @endif
                    </div>
                    <div><small style="color: blue">Gambar maksimal 200 kb (jpg,jpeg,png)</small></div>
                    <div class="input-group mt-1">
                        <span class="input-group-btn">
                            <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                <i class="fa fa-picture-o"></i> Upload/Pilih Gambar
                            </a>
                        </span>
                        <input class="form-control @error('image') is-invalid @enderror" type="text" id="thumbnail"
                            name="image" value="{{ $artikel->image }}" hidden>
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
                        name="caption" value="{{ old('caption', $artikel->caption) }}">
                    @error('caption')
                        <div class="invalid-feedback">
                            Caption belum dibuat
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="credit" class="form-label">Fotografer / Kredit Foto</label>
                    <input type="text" class="form-control @error('credit') is-invalid @enderror" id="credit"
                        name="credit" value="{{ old('credit', $artikel->credit) }}">
                    @error('credit')
                        <div class="invalid-feedback">
                            Nama fotografer / kredit foto belum diisi
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success my-5">Edit Artikel</button>
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
            fetch("/dapur-imajinasi/ruangredaksi/konsepSlug?title=" + title.value)
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
