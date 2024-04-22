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
@endsection
@section('container')
    <div class="row my-2 justify-content-between">
        
        <div class="row my-1 justify-content-between">
            {{-- corosel baru --}}
        
        @foreach ($rekomendasi as $item)
        <div class="col my-4 px-2; card;" style="width: 16rem; ">
            <img src="{{ $item->image }}" alt="{{ $item->title }}"  width="235px" height="140px" >
            <div class="card-body"style="text-align:center;" >
              <a href="/artikel/rlo-{{ $item->id }}/{{ $item->slug }}"><h5 style="color: black" class="card-text">{{ $item->title }}</h5></a>
              {{-- <p class="card-text" style="font-size: 14px">Some quick example.</p> --}}
              {{-- class="btn btn-danger" style="col my-4 px-2;">Baca</a> --}}
            </div>
        </div>
        @endforeach
        

        </div>

        <div class="col-md-8">

            <!--carousel-->
            @include('partials.headline')
            <!--carousel end-->

            <!--iklan dibawah headline-->
            @include('partials.iklandibawahheadline')
            <!--iklan dibawah headline end-->

            <div class="col my-3 px-2" style="background-color: #ff4500; color: white">
                <h3>ARTIKEL TERKINI</h3>
            </div>
            <!-- Artikel 1-5 -->
            <div class="">
                @foreach ($artikels->take(5) as $artikel)
                    <div class="col d-flex my-3 border-bottom">
                        @if ($artikel->image)
                            <a href="/artikel/rlo-{{ $artikel->id }}/{{ $artikel->slug }}">
                                <img src="{{ $artikel->image }}" alt="{{ $artikel->title }}" class="me-2 home-img">
                            </a>
                        @else
                            <a href="/artikel/rlo-{{ $artikel->id }}/{{ $artikel->slug }}">
                                <img src="{{ asset('img') }}/content.jpg" alt="{{ $artikel->title }}"
                                    class="me-2 home-img">
                            </a>
                        @endif
                        <div class="">
                            <h2>
                                <a class="link text-decoration-none text-dark"
                                    href="/artikel/rlo-{{ $artikel->id }}/{{ $artikel->slug }}">
                                    {{ $artikel->title }}
                                </a>
                                <br>
                                <small class="link text-uppercase fw-bold"><a class="text-danger text-decoration-none"
                                        href="/kategori/{{ $artikel->category->id }}/{{ $artikel->category->slug }}">{{ $artikel->category->name }}</a>
                                </small>
                                <small class="text-center"> |
                                    {{-- {{ $artikel->published_at }} WIB --}}
                                    {{ $artikel->published_at->diffForHumans() }}
                                </small>
                            </h2>
                        </div>
                    </div>
                @endforeach
            </div>

            <!--iklan home 1-->
            @include('partials.iklanhome1')
            <!--iklan home 1 end-->

            <!-- Artikel 5-10 -->
            <div class="mb-3">
                @foreach ($artikels->skip(5)->take(5) as $artikel)
                    <div class="col d-flex my-2 border-bottom">
                        @if ($artikel->image)
                            <a href="/artikel/rlo-{{ $artikel->id }}/{{ $artikel->slug }}">
                                <img src="{{ $artikel->image }}" alt="{{ $artikel->title }}" class="me-2 home-img">
                            </a>
                        @else
                            <a href="/artikel/rlo-{{ $artikel->id }}/{{ $artikel->slug }}">
                                <img src="{{ asset('img') }}/content.jpg" alt="{{ $artikel->title }}"
                                    class="me-2 home-img">
                            </a>
                        @endif
                        <div class="mt-2">
                            <h2>
                                <a class="link text-decoration-none text-dark"
                                    href="/artikel/rlo-{{ $artikel->id }}/{{ $artikel->slug }}">
                                    {{ $artikel->title }}
                                </a>
                                <br>
                                <small class="link text-uppercase fw-bold"><a class="text-danger text-decoration-none"
                                        href="/kategori/{{ $artikel->category->id }}/{{ $artikel->category->slug }}">{{ $artikel->category->name }}</a>
                                </small> |
                                <small class="text-center">
                                    {{ $artikel->published_at->diffForHumans() }}
                                </small>
                            </h2>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!--main sidebar 1-->
        <div class="col-md-4 offset-md">
            @include('partials.mainsidebar1')
        </div>
        <!--main sidebar 1 end-->
    </div>

    <!-- Foto -->
    <div class="row">
        <div class="col">
            <!--iklan home 2-->
            @include('partials.iklanhome2')
            <!--iklan home 2 end-->
        </div>

        <div class="container-fluid my-3 bg-dark">
            <div class="col my-2 pt-2 text-white">
                <h3>FOTO</h3>
            </div>
            <div class="card-group mb-3 gap-3 mx-3 my-3">
                @foreach ($images as $gambar)
                    <div class="card rounded shadow-lg border-0">
                        @if ($gambar->image)
                            <a href="/foto/rlo-{{ $gambar->id }}/{{ $gambar->slug }}">
                                <img src="{{ $gambar->image }}" alt="{{ $gambar->name }}" class="pilihan-img">
                            </a>
                        @else
                            <a href="/foto/rlo-{{ $gambar->id }}/{{ $gambar->slug }}">
                                <img src="{{ asset('img') }}/content.jpg" alt="{{ $gambar->name }}" class="pilihan-img">
                            </a>
                        @endif
                        <div class="card-body fw-bold">
                            <h2>
                                <a class="link text-decoration-none text-dark"
                                    href="/foto/rlo-{{ $gambar->id }}/{{ $gambar->slug }}">{{ $gambar->name }}</a>
                            </h2>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-3 pb-2">
                <h4>
                    <a class="text-white fw-bold text-decoration-none btn btn-sm btn-primary mb-2 border-0"
                        href="/list-foto" style="background-color: #ff4500; color: white">Lihat
                        Selengkapnya</a>
                </h4>
            </div>
        </div>
        <div class="col">
            <!--iklan home 3-->
            @include('partials.iklanhome3')
            <!--iklan home 3 end-->
        </div>
    </div>
    <!-- Pilihan Editor -->
    <div class="row">
        <div class="container-fluid my-3 bg-dark">
            <div class="col my-2 pt-2 text-white">
                <h3>PILIHAN EDITOR</h3>
                <div class="card-group mb-3 gap-3 mx-3 my-3">
                    @foreach ($pilihan as $artikel)
                        <div class="card border-0">
                            @if ($artikel->image)
                                <a href="/artikel/rlo-{{ $artikel->id }}/{{ $artikel->slug }}">
                                    <img src="{{ $artikel->image }}" alt="{{ $artikel->title }}" class="pilihan-img">
                                </a>
                            @else
                                <a href="/artikel/rlo-{{ $artikel->id }}/{{ $artikel->slug }}">
                                    <img src="{{ asset('img') }}/content.jpg" alt="{{ $artikel->title }}"
                                        class="pilihan-img">
                                </a>
                            @endif
                            <div class="card-body fw-bold">
                                <h2>
                                    <a class="link text-decoration-none text-dark"
                                        href="/artikel/rlo-{{ $artikel->id }}/{{ $artikel->slug }}">
                                        {{ $artikel->title }}
                                    </a>
                                </h2>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="text-center mt-3 pb-2">
                <h4>
                    <a class="text-white fw-bold text-decoration-none btn btn-sm btn-primary mb-2 border-0"
                        href="/pilihan-editor" style="background-color: #ff4500; color: white">Lihat
                        Selengkapnya</a>
                </h4>
            </div>
        </div>

    </div>


    <div class="row my-2 justify-content-between">
        <div class="col-md-8">
            <!--iklan home 4-->
            @include('partials.iklanhome4')
            <!--iklan home 4 end-->
            <!-- Artikel 11-15 -->
            <div class="mb-3">
                @foreach ($artikels->skip(10)->take(5) as $artikel)
                    <div class="col d-flex my-2 border-bottom">
                        @if ($artikel->image)
                            <a href="/artikel/rlo-{{ $artikel->id }}/{{ $artikel->slug }}">
                                <img src="{{ $artikel->image }}" alt="{{ $artikel->title }}" class="me-2 home-img">
                            </a>
                        @else
                            <a href="/artikel/rlo-{{ $artikel->id }}/{{ $artikel->slug }}">
                                <img src="{{ asset('img') }}/content.jpg" alt="{{ $artikel->title }}"
                                    class="me-2 home-img">
                            </a>
                        @endif
                        <div class="mt-2">
                            <h2>
                                <a class="link text-decoration-none text-dark"
                                    href="/artikel/rlo-{{ $artikel->id }}/{{ $artikel->slug }}">
                                    {{ $artikel->title }}
                                </a>
                                <br>
                                <small class="link text-uppercase fw-bold"><a class="text-danger text-decoration-none"
                                        href="/kategori/{{ $artikel->category->id }}/{{ $artikel->category->slug }}">{{ $artikel->category->name }}</a>
                                </small> |
                                <small class="text-center">
                                    {{ $artikel->published_at->diffForHumans() }}
                                </small>
                            </h2>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-5 pb-2">
                <h4>
                    <a class="text-white fw-bold text-decoration-none btn btn-sm btn-primary mb-2 border-0" href="/indeks"
                        style="background-color: #ff4500; color: white">Artikel Lainnya</a>
                </h4>
            </div>
        </div>
        <!--main sidebar 2-->
        <div class="col-md-4 offset-md">
            @include('partials.mainsidebar2')
        </div>
        <!--main sidebar 2 end-->
    </div>
@endsection
