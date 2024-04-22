@extends('layouts.logreg')
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
@endsection
@section('container')
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            {{-- Notifikasi Login User Sukses --}}
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Notifikasi Login User Gagal --}}
            @if (session()->has('loginError'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('loginError') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>


    <div class="text-center mt-5">
        @if ($icon)
            <img src="{{ asset('storage/' . $icon) }}" alt="{{ $title }}" class="my-4" alt=""
                width="100" height="100">
        @else
            <img src="{{ asset('img') }}/icon-default.png" alt="{{ $title }}" class="my-4" alt=""
                width="100" height="100">
        @endif
        {{-- <img class="my-4" src="{{ asset('img') }}/icon.png" alt="" width="100" height="100"> --}}
        <h1 class="h3 my-3 fw-normal">Silahkan Login</h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8 my-5">
            <main class="form-signin m-auto my-3">
                <form action="/masuk/dapur-redaksi/login" method="post">
                    @csrf
                    <div class="form-floating mb-2">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            id="email" placeholder="name@gmail.com" autofocus required value="{{ old('email') }}">
                        <label for="email">Email address</label>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password"
                            required>
                        <label for="password">Password</label>
                    </div>

                    <button class="w-100 btn btn-lg btn-dark fw-bold my-3" type="submit">Login</button>
                    <div class="text-center">
                        {{-- <p class="d-block"></p> Belum punya akun? <a href="/daftar/penulis"
                        class="text-decoration-none text-danger fw-bold">Daftar Jadi Penulis</a></p> --}}
                        <p class="my-3"></p> Kembali ke <a href="/"
                            class="text-decoration-none text-danger fw-bold">{{ $domain }}</a>
                        </p>
                        <p class="my-5 text-muted">Copyright &copy; 2023 {{ $domain }}.
                            All right reserved</p>
                    </div>

                </form>
            </main>
        </div>
    </div>
@endsection
