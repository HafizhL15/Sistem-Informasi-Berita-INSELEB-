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
    <div class="row my-2 justify-content-between">
        <div class="col-md-8">
            <!--carousel-->
            @include('partials.headline')
            <!--carousel end-->

            <!--iklan dibawah headline-->
            @include('partials.iklandibawahheadline')
            <!--iklan dibawah headline end-->
            <div class="col px-2" style="background-color: #0057a1; color: white">
                <h3>FOTO</h3>
            </div>
            <!-- foto -->
            @if ($images->count())
                <div class="">
                    @foreach ($images as $foto)
                        <div class="col d-flex my-3 border-bottom">
                            @if ($foto->image)
                                <a href="/foto/rlo-{{ $foto->id }}/{{ $foto->slug }}">
                                    <img src="{{ $foto->image }}" alt="{{ $foto->name }}" class="me-2 home-img">
                                </a>
                            @else
                                <a href="/foto/rlo-{{ $foto->id }}/{{ $foto->slug }}">
                                    <img src="{{ asset('img') }}/content.jpg" alt="{{ $foto->name }}"
                                        class="me-2 home-img">
                                </a>
                            @endif
                            <div class="">
                                <h2>
                                    <a class="link text-decoration-none text-dark"
                                        href="/foto/rlo-{{ $foto->id }}/{{ $foto->slug }}">
                                        {{ $foto->name }}
                                    </a>
                                    <br>
                                    <small class="text-center">
                                        {{ $foto->created_at->diffForHumans() }}
                                    </small>
                                </h2>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <h4 class="text-center">Tidak ada foto yang ditemukan</h4>
            @endif
            <!--pagination-->
            <div class="my-4 d-flex justify-content-center">
                {{ $images->links() }}
            </div>
            <!--pagination end-->
        </div>

        <!-- sidebar -->
        <div class="col-md-4 offset-md">
            @include('partials.sidebarartikel')
        </div>
        <!-- sidebar end -->
    </div>
@endsection
