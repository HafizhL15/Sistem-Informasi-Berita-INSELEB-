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
    <meta property="fb:app_id" content="217756867576553" />
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
@endsection
@section('container')
    <!--form pendaftaran penulis-->
    <div class="container justify-content-center">
        <div class="my-5">
            <h4 class="text-center fw-bold">FORMULIR PENDAFTARAN PENULIS</h4>
        </div>
        {{-- @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif --}}
        <div class="my-3 fw-bold">
            <form method="post" action="/daftar-penulis" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control text-muted @error('name') is-invalid @enderror" id="name"
                        name="name" value="">
                    <div class="invalid-feedback">
                        Nama lengkap belum diisi
                    </div>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Alamat</label>
                    <input type="text" class="form-control text-muted @error('address') is-invalid @enderror"
                        id="address" name="address" value="">
                    <div class="invalid-feedback">
                        Alamat belum diisi
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email Aktif</label>
                    <input type="email" class="form-control text-muted @error('email') is-invalid @enderror"
                        id="email" name="email" value="">
                    <div class="invalid-feedback">
                        Email salah / Belum diisi / Coba Email lain
                    </div>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">WhatsApp Aktif</label>
                    <input type="number" class="form-control text-muted @error('phone') is-invalid @enderror"
                        id="phone" name="phone" minlength="8" maxlength="13" value="">
                    <div class="invalid-feedback">
                        No.telp belum diisi atau format nomor salah</div>
                </div>
                <div class="mb-3">
                    <label for="web" class="form-label">Website</label>
                    <input type="text" class="form-control text-muted" id="web" name="web" value="">
                </div>
                <div class="mb-3">
                    <label for="facebook" class="form-label">Facebook</label>
                    <input type="text" class="form-control text-muted" id="facebook" name="facebook" value="">
                </div>
                <div class="mb-3">
                    <label for="linkedin" class="form-label">Linkedin</label>
                    <input type="text" class="form-control text-muted" id="linkedin" name="linkedin"
                        value="">
                </div>
                <div class="mb-3">
                    <label for="twitter" class="form-label">Twitter</label>
                    <input type="text" class="form-control text-muted" id="twitter" name="twitter" value="">
                </div>
                <div class="mb-3">
                    <label for="instagram" class="form-label">Instagram</label>
                    <input type="text" class="form-control text-muted" id="instagram" name="instagram"
                        value="">
                </div>
                <div class="mb-3">
                    <label for="youtube" class="form-label">Youtube</label>
                    <input type="text" class="form-control text-muted" id="youtube" name="youtube" value="">
                </div>
                <div class="mb-3">
                    <label for="tiktok" class="form-label">TikTok</label>
                    <input type="text" class="form-control text-muted" id="tiktok" name="tiktok" value="">
                </div>

                <div class="my-3">
                    <label for="image" class="form-label">Foto KTP</label>
                    <div>
                        <img class="img-preview img-fluid mb-3 col-sm-3">
                    </div>
                    <div><small style="color: blue">Gambar maksimal 200 kb (jpg,jpeg,png)</small></div>
                    <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                        name="image" accept="image/*" onchange="previewImage()">
                    @error('image')
                        <div class="invalid-feedback">
                            {{-- {{ $message }} --}}
                            Gambar belum dimasukkan / Ukuran gambar terlalu besar
                        </div>
                    @enderror
                </div>
                <div>
                    <label>Kompres Gambar: <a href="https://squoosh.app" target="_blank"
                            class="text-decoration-none">DISINI</a></label>
                </div>

                <!-- Syarat Ketentuan Modal -->
                <button type="button" class="btn text-white my-3" style="background-color: #0057a1; color: white"
                    data-bs-toggle="modal" data-bs-target="#persetujuan">
                    Daftar Penulis
                </button>
        </div>
        <div class="modal" id="persetujuan">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Syarat & Ketentuan Menjadi Penulis</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Scrollable modal -->
                    <div class="mx-3 my-3">
                        <h4 class="fw-bold">Apa Yang Boleh</h4>
                        <p></p>
                        <h4 class="my-3 fw-bold">Apa Yang Tidak Boleh</h4>
                        <p></p>
                        <h4 class="my-3 fw-bold">Resiko Hukum Atas Isi Artikel Ditanggung Penulis</h4>
                        <p></p>
                    </div>
                    <!--Persetujuan Pendaftar-->
                    <div class="form-check my-3 mx-3">
                        <input class="form-check-input" type="checkbox" value="" id="setuju"
                            onclick="enable()">
                        <label class="form-check-label" for="setuju">
                            Dengan ini <b>Saya</b> menyetujui <b>Syarat dan Ketentuan</b> menjadi penulis
                        </label>
                    </div>
                    <!--Persetujuan Pendaftar end-->

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary text-white" id="btn"
                            disabled="true">Daftar</button>
                    </div>


                </div>
            </div>
        </div>
        </form>
    </div>
    <!--form pendaftaran penulis end-->
    <script>
        function enable() {
            var setuju = document.getElementById("setuju");
            var btn = document.getElementById("btn");
            if (setuju.checked) {
                btn.removeAttribute("disabled");
            } else {
                btn.disabled = "true";
            }
        }
    </script>
    @include('sweetalert::alert')
@endsection
