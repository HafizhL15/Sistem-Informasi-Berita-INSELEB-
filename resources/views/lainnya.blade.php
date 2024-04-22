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
@endsection
@section('container')
    <div class="row my-2">
        <div class="col">
            <div class="row row-cols-1 row-cols-md-4 g-2 my-3">
                @foreach ($categories as $kategori)
                    <div class="col">
                        <div class="card h-100">
                            @if ($kategori->image)
                                <a href="/kategori/{{ $kategori->id }}/{{ $kategori->slug }}">
                                    <img src="{{ $kategori->image }}" alt="{{ $kategori->name }}" class="card-img-top">
                                </a>
                            @else
                                <a href="/kategori/{{ $kategori->id }}/{{ $kategori->slug }}">
                                    <img src="{{ asset('img') }}/content.jpg" alt="{{ $kategori->name }}"
                                        class="card-img-top">
                                </a>
                            @endif
                            <div class="card-body">
                                <h2 class="card-title fw-bolder text-uppercase">
                                    <a class="link text-decoration-none text-dark"
                                        href="/kategori/{{ $kategori->id }}/{{ $kategori->slug }}">{{ $kategori->name }}</a>
                                </h2>
                                <h4 class="card-text">{{ $kategori->description }}</h4>
                            </div>
                            <div class="card-footer">
                                <h4>
                                    <small class="text-center" style="font-size: 14px;">
                                        {{ $kategori->created_at->diffForHumans() }}
                                    </small>
                                </h4>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
