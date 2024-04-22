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
    <!--content-->
    <div class="row my-2">
        <div class="col-md-8">
            <!--breadcumb-->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/"
                            class="text-muted text-decoration-none"><small>NEWS</small></a></li>
                    <li class="breadcrumb-item text-uppercase"><a href="/{{ $info->slug }}"
                            class="text-muted text-decoration-none"><small>{{ $info->title }}</small></a>
                    </li>
                </ol>
            </nav>
            <!--breadcumb end-->

            <!--Isi Artikel-->
            <div class="">
                <h1 class="my-3 text-center">{{ $info->title }}</h1>
                <article class="mt-3 mb-5 fs-5 text-responsive text-decoration-none">
                    {!! $info->body !!}
                </article>
            </div>
            <!--Isi Artikel end-->
        </div>

        <!--Sidebar Artikel-->
        <div class="col-md-4 offset-md">
            @include('partials.sidebarartikel')
        </div>
        <!--Sidebar Artikel-->
    </div>
    <!--content end-->
@endsection
