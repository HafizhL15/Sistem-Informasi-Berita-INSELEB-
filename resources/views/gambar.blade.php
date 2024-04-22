@extends('layouts.main')
@section('meta_tags')
    <meta property="article:author" content="{{ $gambar->user->name }}" itemprop="author" />
    <meta property="article:publisher" content="{{ Request::root() }}" />
    <!-- start social media meta seo -->
    <!-- start fb:meta -->
    <meta property="og:type" content="article" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:site_name" content="{{ $domain }}" />
    <meta property="og:title" content="{{ $title }}" />
    <meta property="og:description" content="{{ $description }}" />
    <meta property="og:image" content="{{ $gambar->image }}" />
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
    <meta name="twitter:image" content="{{ $gambar->image }}" />
    <meta name="twitter:domain" content="{{ $domain }}">
    <!-- End twitter:meta -->

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "BreadcrumbList",
            "itemListElement": [
                {
                    "@type": "ListItem",
                    "position": 1,
                    "name": "News",
                    "item": "{{ Request::root() }}"
                },
                {
                    "@type": "ListItem",
                    "position": 2,
                    "name": "{{ $gambar->slug }}",
                    "item": "{{ Request::root() }}/foto/rlo-{{ $gambar->id }}/{{ $gambar->slug }}"
                }
                ]}
    </script>

    <script type="application/ld+json">
    	{
    		"@context": "https://schema.org",
    		"@type": "WebPage",
    		"headline": "{{ $gambar->name }}",
    		"url": "{{ Request::root() }}/foto/rlo-{{ $gambar->id }}/{{ $gambar->slug }}",
    		"datePublished": "{{ $gambar->created_at->translatedFormat('Y-m-dTH:i:s+07:00') }}",
    		"image": "{{ $gambar->image }}",
            "thumbnailUrl": "{{ $gambar->image }}"
    	}
    </script>

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
			"@type": "NewsArticle",
			"mainEntityOfPage": {
				"@type": "WebPage",
				"@id": "{{ Request::root() }}/foto/rlo-{{ $gambar->id }}/{{ $gambar->slug }}"
			},
			"headline": "{{ $gambar->name }}",
			"image": {
				"@type": "ImageObject",
			    "url": "{{ $gambar->image }}"
            },
			"datePublished": "{{ $gambar->created_at->translatedFormat('Y-m-dTH:i:s+07:00') }}",
			"dateModified": "{{ $gambar->updated_at->translatedFormat('Y-m-dTH:i:s+07:00') }}",
			"author": {
				"@type": "Person",
				"name": "{{ $gambar->user->name }}"
			},
			"publisher": {
				"@type": "Organization",
				"name": "{{ $name }}",
				"logo": {
					"@type": "ImageObject",
					"url": "{{ asset('storage/' . $logo) }}"
				}
			},
			"description": "{{ $gambar->caption }}"
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
                    <li class="breadcrumb-item text-uppercase"><a href="/foto/rlo-{{ $gambar->id }}/{{ $gambar->slug }}"
                            class="text-muted text-decoration-none"><small>{{ $gambar->name }}</small></a>
                    </li>
                </ol>
            </nav>
            <!--breadcumb end-->

            <!--Isi Konten-->
            <div class="">
                <h1 class="my-3 text-center">{{ $gambar->name }}</h1>
                <p class="text-center" style="font-size: 14px;"><strong class="text-danger">
                        {{ $gambar->user->name }}</strong> -
                    {{ $gambar->created_at->translatedFormat('l, d M Y - H:i') }} WIB
                </p>
                <div class="text-center mb-1">
                    @if ($gambar->image)
                        <img src="{{ $gambar->image }}" alt="{{ $gambar->name }}" class="me-2 artikel-img rounded">
                    @else
                        <img src="{{ asset('img') }}/content.jpg" alt="{{ $gambar->name }}"
                            class="me-2 artikel-img rounded">
                    @endif
                </div>
                <small>{{ $gambar->caption }}</small>
                <article class="mt-3 mb-5 fs-5 text-responsive text-decoration-none">
                    {!! $gambar->body !!}
                    @yield('partials.iklandidalamartikel')
                </article>

                <h5 class="mt-3 mb-5">
                    <strong>Sumber/Kredit Foto: {{ $gambar->sumber }}</strong>
                </h5>

                <!--iklan dibawah kontent-->
                @include('partials.iklandibawahartikel')
                <!--iklan dibawah kontent end-->
            </div>
            <!--Isi Konten end-->


        </div>

        <!--Sidebar Artikel-->
        <div class="col-md-4 offset-md">
            @include('partials.sidebarartikel')
        </div>
        <!--Sidebar Artikel-->
    </div>

    <!--content end-->
@endsection
