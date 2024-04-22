@extends('layouts.main')
@section('meta_tags')
    <meta property="article:author" content="{{ Request::root() }}" itemprop="author" />
    <meta property="article:publisher" content="{{ Request::root() }}" />
    <!-- start social media meta seo -->
    <!-- start fb:meta -->
    <meta property="og:type" content="article" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:site_name" content="{{ $domain }}" />
    <meta property="og:title" content="{{ $title }}" />
    <meta property="og:description" content="{{ $description }}" />
    <meta property="og:image" content="{{ asset('storage/' . $icon) }}" />
    <meta property="fb:app_id" content="1938207656301394" />
    <meta property="fb:pages" content="129301370465982" />
    <!-- end fb:meta -->
    <!-- Start twitter:meta -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="{{ $domain }}" />
    <meta name="twitter:site:id" content="{{ $domain }}" />
    <meta name="twitter:creator" content="{{ $domain }}">
    <meta name="twitter:title" content="{{ $title }}" />
    <meta name="twitter:description" content="{{ $description }}" />
    <meta name="twitter:image" content="{{ asset('storage/' . $icon) }}" />
    <meta name="twitter:domain" content="{{ $domain }}" />
    <!-- End twitter:meta -->

    <script type='application/ld+json'>
        {
            "@context" : "https://schema.org",
            "@type" : "Organization",
            "name" : "{{ $name }}",
            "url" : "{{ Request::root() }}",
            "sameAs" : [
                "{{ $website->first()->facebook }}",
                "{{ $website->first()->twitter }}",
                "{{ $website->first()->instagram }}",
                "{{ $website->first()->youtube }}",
                "{{ $website->first()->tiktok }}"
            ],
            "logo": "{{ asset('storage/' . $logo) }}"
        }
    </script>
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebSite",
            "url": "{{ Request::root() }}",
            "potentialAction": {
            "@type": "SearchAction",
            "target": "{{ Request::root() }}/cari-artikel?search={search_term_string}",
            "query-input": "required name=search_term_string"
            }
        }
    </script>
    <script type="application/ld+json">
    	{
    		"@context": "https://schema.org",
    		"@type": "WebPage",
    		"headline": "{{ $title }}",
    		"url": "{{ url()->current() }}",
    		"image": "{{ asset('storage/' . $logo) }}",
    		"thumbnailUrl": "{{ asset('storage/' . $logo) }}"
    	}
    </script>

    <!-- Summernote -->
    <link href="{{ asset('assets') }}/plugins/summernote/summernote-bs5.css" rel="stylesheet">
@endsection

@section('container')
    <!--form kirim artikel-->
    <div class="container justify-content-center">
        <div class="my-5">
            <h4 class="text-center fw-bold">KIRIM ARTIKEL / OPINI</h4>
        </div>
        <div class="my-3">
            <form method="post" action="/kirim-artikel" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label fw-bold">Judul Artikel / Opini</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                        name="title" maxlength="110" value="{{ old('title') }}">
                    @error('title')
                        <div class="invalid-feedback">
                            Judul Artikel / Opini belum dibuat
                        </div>
                    @enderror
                    <small style="color: red">Maksimal 110 Karakter</small>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label fw-bold">Deskripsi</label>
                    <input type="text" class="form-control @error('description') is-invalid @enderror" id="description"
                        name="description" maxlength="170" value="{{ old('description') }}">
                    @error('description')
                        <div class="invalid-feedback">
                            Deskripsi belum diisi
                        </div>
                    @enderror
                    <small style="color: red">Maksimal 170 Karakter</small>
                </div>

                <div class="mb-3">
                    <label for="body" class="form-label fw-bold">Isi Artikel / Opini</label>
                    <div>
                        <textarea id="summernote" name="body" class="form-control @error('body') is-invalid @enderror"
                            value="{{ old('body') }}"></textarea>
                    </div>
                    @error('body')
                        <div class="" style="font-size: .875em; color: #b02a37">
                            Konten belum diisi
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="sumber" class="form-label fw-bold">Sumber Artikel</label>
                    <div><small style="color: red">Jika mengutip dari Media Sosial / Situs Luar Negeri / Bukan
                            Opini</small></div>
                    <input type="text" class="form-control" id="sumber" name="sumber" value="{{ old('sumber') }}">
                </div>

                <div class="my-3">
                    <label for="image" class="form-label fw-bold">Gambar Artikel</label>
                    <div>
                        <img class="img-preview img-fluid mb-3 col-sm-3">
                    </div>
                    <div><small style="color: red">Gambar maksimal 200 kb (jpg,jpeg,png)</small></div>
                    <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                        name="image" accept="image/*" onchange="previewImage()">
                    @error('image')
                        <div class="invalid-feedback">
                            Gambar belum dimasukkan / Ukuran gambar terlalu besar
                        </div>
                    @enderror
                </div>
                <div class="fw-bold">
                    <label>Kompres Gambar: <a href="https://squoosh.app" target="_blank"
                            class="text-decoration-none">DISINI</a></label>
                </div>

                <div class="my-3">
                    <label for="namapengirim" class="form-label fw-bold">Nama Lengkap Pengirim</label>
                    <input type="text" class="form-control @error('namapengirim') is-invalid @enderror"
                        id="namapengirim" name="namapengirim" value="{{ old('namapengirim') }}">
                    @error('namapengirim')
                        <div class="invalid-feedback">
                            Nama lengkap belum diisi
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn text-white my-3" style="background-color: #ff4500; color: white"">Kirim
                    Artikel</button>
            </form>
        </div>

    </div>
    <!--form kirim artikel end-->
    @include('sweetalert::alert')
@endsection
