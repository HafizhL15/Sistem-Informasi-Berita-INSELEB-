@extends('dapur.layouts.main')

@section('container')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="text-center mt-1 mb-5">
                    <h4 class="fw-bolder">EDIT PENGATURAN SITUS</h4>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="mx-1">
            <form method="post" action="/dapur-imajinasi/ruangredaksi/website/{{ $website->slug }}"
                enctype="multipart/form-data">
                @method('put')
                @csrf

                <div class="row justify-content-between g-5 mx-1 bg-white rounded mb-3">
                    <div class="col-md-6 mb-3">
                        <div class="mb-4">
                            <h4 class="fw-bolder">Info Situs</h4>
                        </div>
                        <div class="">
                            <label for="name" class="form-label">Nama Website</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" maxlength="30" value="{{ old('name', $website->name) }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    Nama website belum diisi
                                </div>
                            @enderror
                            <small style="color: blue">Maksimal 30
                                Karakter</small>
                        </div>

                        <div class="mb-3">
                            <label for="domain" class="form-label">Domain Website</label>
                            <input type="text" class="form-control @error('domain') is-invalid @enderror" id="domain"
                                name="domain" maxlength="30" value="{{ old('domain', $website->domain) }}">
                            @error('domain')
                                <div class="invalid-feedback">
                                    Domain website belum diisi
                                </div>
                            @enderror
                            <small style="color: blue">Maksimal 30
                                Karakter</small>
                        </div>

                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                                name="slug" value="{{ old('slug', $website->slug) }}" readonly>
                            @error('slug')
                                <div class="invalid-feedback">
                                    Slug harus diisi atau otomatis terisi setelah membuat nama kategori
                                </div>
                            @enderror
                            <small style="color: blue">Slug SEO Otomatis</small>
                        </div>

                        <div class="mb-3">
                            <label for="slogan" class="form-label">Slogan Website</label>
                            <input type="text" class="form-control @error('slogan') is-invalid @enderror" id="slogan"
                                name="slogan" maxlength="170" value="{{ old('slogan', $website->slogan) }}">
                            @error('slogan')
                                <div class="invalid-feedback">
                                    Slogan website belum diisi
                                </div>
                            @enderror
                            <small style="color: blue">Maksimal 170
                                Karakter</small>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <div>
                                <textarea class="form-control" id="description" name="description">{{ old('description', $website->description) }}</textarea>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="meta_title" class="form-label">Meta Title</label>
                            <input type="text" class="form-control" id="meta_title" name="meta_title"
                                value="{{ old('meta_title', $website->meta_title) }}">
                        </div>

                        <div class="mb-3">
                            <label for="meta_description" class="form-label">Meta Deskripsi</label>
                            <div>
                                <textarea class="form-control" id="meta_description" name="meta_description">{{ old('meta_description', $website->meta_description) }}</textarea>
                            </div>
                        </div>

                        <div class="">
                            <label for="meta_keyword" class="form-label">Meta Keyword</label>
                            <div>
                                <textarea class="form-control" id="meta_keyword" name="meta_keyword">{{ old('meta_keyword', $website->meta_keyword) }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-4">
                            <h4 class="fw-bolder">Akun Media Sosial</h4>
                        </div>
                        <div class="mb-3">
                            <label for="facebook" class="form-label">Facebook</label>
                            <div>
                                <input class="form-control" id="facebook" name="facebook"
                                    value="{{ old('facebook', $website->facebook) }}"></input>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="twitter" class="form-label">Twitter</label>
                            <div>
                                <input class="form-control" id="twitter" name="twitter"
                                    value="{{ old('twitter', $website->twitter) }}"></input>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="instagram" class="form-label">Instagram</label>
                            <div>
                                <input class="form-control" id="instagram" name="instagram"
                                    value="{{ old('instagram', $website->instagram) }}"></input>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="youtube" class="form-label">Youtube</label>
                            <div>
                                <input class="form-control" id="youtube" name="youtube"
                                    value="{{ old('youtube', $website->youtube) }}"></input>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="tiktok" class="form-label">TikTok</label>
                            <div>
                                <input class="form-control" id="tiktok" name="tiktok"
                                    value="{{ old('tiktok', $website->tiktok) }}"></input>
                            </div>
                        </div>

                        <div class="my-3">
                            <label for="image" class="form-label">Logo Website</label>
                            <input type="hidden" name="oldImage" value="{{ $website->image }}">
                            @if ($website->image)
                                <img
                                    src="{{ asset('storage/' . $website->image) }}"class="img-preview img-fluid mb-3 col-sm-3 d-block">
                            @else
                                <img class="img-preview img-fluid mb-3 col-sm-3">
                            @endif
                            <input class="form-control @error('image') is-invalid @enderror" type="file"
                                id="image" name="image" onchange="previewImage()">
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <small style="color: blue">Gambar maksimal 200 kb (jpg,jpeg,png) - Ukuran idel 200x50
                                pixel</small>
                        </div>

                        <div class="my-3">
                            <label for="icon" class="form-label">Icon Website</label>
                            <input type="hidden" name="oldIcon" value="{{ $website->icon }}">
                            @if ($website->icon)
                                <img src="{{ asset('storage/' . $website->icon) }}"
                                    class="icon-preview img-fluid mb-3 col-sm-3 d-block">
                            @else
                                <img class="icon-preview img-fluid mb-3 col-sm-3">
                            @endif

                            <input class="form-control @error('icon') is-invalid @enderror" type="file" id="icon"
                                name="icon" onchange="previewIcon()">
                            @error('icon')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <small style="color: blue">Gambar maksimal 200 kb (jpg,jpeg,png) - Ukuran maksimal 512x512
                                pixel</small>
                        </div>
                    </div>
                </div>

                <div class="row mx-1 bg-white rounded mt-4">
                    <div class="my-3">
                        <label for="meta_header" class="form-label">Script Header</label>
                        <div>
                            <textarea class="form-control" id="meta_header" name="meta_header">{{ old('hemeta_headerader', $website->meta_header) }}</textarea>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="meta_footer" class="form-label">Script Footer</label>
                        <div>
                            <textarea class="form-control" id="meta_footer" name="meta_footer">{{ old('meta_footer', $website->meta_footer) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <button type="submit" class="btn btn-success my-5">Update Pengaturan Situs</button>
                </div>
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
            fetch("/dapur-imajinasi/ruangredaksi/webSlug?name=" + name.value)
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

    <!-- ICON Preview -->
    <script>
        function previewIcon() {
            const icon = document.querySelector('#icon');
            const iconPreview = document.querySelector('.icon-preview');

            iconPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(icon.files[0]);

            oFReader.onload = function(oFREvent) {
                iconPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
