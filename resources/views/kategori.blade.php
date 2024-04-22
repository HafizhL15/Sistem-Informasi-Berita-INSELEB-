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
@endsection
@section('container')
    <!--content-->
    <div class="row my-2 justify-content-between">
        <div class="col-md-8">
            <!--carousel-->
            @include('partials.headline')
            <!--carousel end-->
            <!--iklan dibawah headline-->
            @include('partials.iklandibawahheadline')
            <!--iklan dibawah headline end-->

            <div class="col my-3 px-2 text-uppercase" style="background-color: #ff4500; color: white">
                <h3>{{ $judul }}</h3>
            </div>

            @if ($artikel_kategori->count())
                <div class="">
                    @foreach ($artikel_kategori->take(5) as $artikel)
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

                <div class="mb-3">
                    @foreach ($artikel_kategori->skip(5)->take(5) as $artikel)
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
                                <h5><a class="link text-decoration-none text-dark"
                                        href="/artikel/rlo-{{ $artikel->id }}/{{ $artikel->slug }}">{{ $artikel->title }}</a>
                                </h5>
                                <small class="link text-uppercase fw-bold"><a
                                        class="text-danger font-size: 14px; text-decoration-none"
                                        href="/kategori/{{ $artikel->category->id }}/{{ $artikel->category->slug }}">{{ $artikel->category->name }}</a>
                                </small> |
                                <small class="text-center" style="font-size: 14px;">
                                    {{ $artikel->published_at->diffForHumans() }}
                                </small>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!--iklan home 2-->
                @include('partials.iklanhome2')
                <!--iklan home 2 end-->

                <!--iklan home 3-->
                @include('partials.iklanhome3')
                <!--iklan home 3 end-->

                <div class="mb-3">
                    @foreach ($artikel_kategori->skip(10)->take(5) as $artikel)
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
                                <h5><a class="link text-decoration-none text-dark"
                                        href="/artikel/rlo-{{ $artikel->id }}/{{ $artikel->slug }}">{{ $artikel->title }}</a>
                                </h5>
                                <small class="link text-uppercase fw-bold"><a
                                        class="text-danger font-size: 14px; text-decoration-none"
                                        href="/kategori/{{ $artikel->category->id }}/{{ $artikel->category->slug }}">{{ $artikel->category->name }}</a>
                                </small> |
                                <small class="text-center" style="font-size: 14px;">
                                    {{ $artikel->published_at->diffForHumans() }}
                                </small>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center fs-4">Tidak ada artikel yang ditemukan</p>
            @endif
            <!--pagination-->
            <div class="my-4 d-flex justify-content-center">
                {{ $artikel_kategori->links() }}
            </div>
            <!--pagination end-->

            <!--iklan home 4-->
            @include('partials.iklanhome4')
            <!--iklan home 4 end-->
        </div>

        <!--main sidebar 1-->
        <div class="col-md-4 offset-md">
            @include('partials.sidebarkategori')
        </div>
        <!--main sidebar 1 end-->
    </div>
    <!--content end-->
@endsection
