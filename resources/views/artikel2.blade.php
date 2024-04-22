@extends('layouts.main')
@section('meta_tags')
    <meta property="article:author" content="{{ $artikel->author->name }}" itemprop="author" />
    <meta property="article:publisher" content="{{ Request::root() }}" />
    <!-- start social media meta seo -->
    <!-- start fb:meta -->
    <meta property="og:type" content="article" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:site_name" content="{{ $domain }}" />
    <meta property="og:title" content="{{ $title }}" />
    <meta property="og:description" content="{{ $description }}" />
    <meta property="og:image" content="{{ $artikel->image }}" />
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
    <meta name="twitter:image" content="{{ $artikel->image }}" />
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
                    "name": "{{ $artikel->category->name }}",
                    "item": "{{ Request::root() }}/kategori/{{ $artikel->category->id }}/{{ $artikel->category->slug }}"
                }
                ]}
    </script>

    <script type="application/ld+json">
    	{
    		"@context": "https://schema.org",
    		"@type": "WebPage",
    		"headline": "{{ $artikel->title }}",
    		"url": "{{ Request::root() }}/artikel/rlo-{{ $artikel->id }}/{{ $artikel->slug }}",
    		"datePublished": "{{ $artikel->published_at->translatedFormat('Y-m-dTH:i:s+07:00') }}",
    		"image": "{{ $artikel->image }}",
            "thumbnailUrl": "{{ $artikel->image }}"
    	}
    </script>

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
			"@type": "NewsArticle",
			"mainEntityOfPage": {
				"@type": "WebPage",
				"@id": "{{ Request::root() }}/artikel/rlo-{{ $artikel->id }}/{{ $artikel->slug }}"
			},
			"headline": "{{ $artikel->title }}",
			"image": {
				"@type": "ImageObject",
			    "url": "{{ $artikel->image }}"
            },
			"datePublished": "{{ $artikel->published_at->translatedFormat('Y-m-dTH:i:s+07:00') }}",
			"dateModified": "{{ $artikel->updated_at->translatedFormat('Y-m-dTH:i:s+07:00') }}",
			"author": {
				"@type": "Person",
				"name": "{{ $artikel->author->name }}"
			},
			"publisher": {
				"@type": "Organization",
				"name": "{{ $name }}",
				"logo": {
					"@type": "ImageObject",
					"url": "{{ asset('storage/' . $logo) }}"
				}
			},
			"description": "{{ $artikel->description }}"
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
                    <li class="breadcrumb-item text-uppercase"><a
                            href="/kategori/{{ $artikel->category->id }}/{{ $artikel->category->slug }}"
                            class="text-muted text-decoration-none"><small>{{ $artikel->category->name }}</small></a>
                    </li>
                </ol>
            </nav>
            <!--breadcumb end-->

            <!--Isi Artikel-->
            <div class="">
                <h1 class="my-3 text-center">{{ $artikel->title }}</h1>
                <p class="text-center" style="font-size: 14px;"><strong class="text-danger">
                        {{ $artikel->author->name }}</strong> -
                    {{ $artikel->published_at->translatedFormat('l, d M Y - H:i') }} WIB
                </p>
                <div class="text-center mb-1">
                    @if ($artikel->image)
                        <img src="{{ $artikel->image }}" alt="{{ $artikel->title }}" class="me-2 artikel-img rounded">
                    @else
                        <img src="{{ asset('img') }}/content.jpg" alt="{{ $artikel->title }}"
                            class="me-2 artikel-img rounded">
                    @endif
                </div>
                <small>{{ $artikel->caption }} - {{ $artikel->credit }}</small>
                <!--iklan didalam artikel-->
                @include('partials.iklandidalamartikel')
                <!--iklan didalam artikel end-->
                <article class="mt-0 mb-5 text-responsive text-decoration-none">

                    @foreach ($results as $parts)
                        <p>{!! $parts !!}</p>     
                    @endforeach
                    
                    <div class="py-4 load-more-btn-container text-center d-flex justify-content-center">
                        <button class="btn btn-danger load-more-btn">Load More</button>
                    </div>
                   
                    {{-- @for ($i = 0; $i < (count($items)); $i++)
                        <a id="count"></a>
                        <p id="count">{!! $items[$i] !!}</p>
                    @endfor
                    
                    <button type="button" onClick="onClick()">Read More</button>
                    
                    <script type="text/javascript">
                        var clicks = 0;
                        function onClick() {
                            clicks += 1;
                            document.getElementById("count").innerHTML = clicks;
                        };
                    </script>
                        --}}
                    
                    
                    {{-- <div class="d-flex justify-content-center" style="background-color: #efefef; font-weight: 600">

                        <div class="col-md-2 my-3">
                            <h4>Halaman:</h4>
                        </div>
                        @if ($results->hasPages())
                            <ul class="pagination mt-3"> --}}
                                {{-- Previous Page Link --}}
                                {{-- @if ($results->onFirstPage())
                                    <li class="disabled btn btn-sm btn-secondary mx-1"><span>Prev</span></li>
                                @else
                                    <li class="btn btn-sm mx-1 text-white" style="background-color: #0057a1"><a
                                            href="{{ $results->previousPageUrl() }}" rel="prev"
                                            class="text-white">Sebelumnya</a></li>
                                @endif --}}

                                {{-- Next Page Link --}}
                                {{-- @if ($results->hasMorePages())
                                    <li class="btn btn-sm mx-1" style="background-color: #0057a1"><a
                                            href="{{ $results->nextPageUrl() }}" rel="next"
                                            class="text-white">Selanjutnya</a></li>
                                @else
                                    <li class="disabled btn btn-sm btn-secondary mx-1"><span>Last</span></li>
                                @endif
                            </ul>
                        @endif
                    </div> --}}
                    <div class="mt-3">
                        <h6><i>Ikuti kami di <b>Google News</b> untuk update informasi
                                dan artikel terbaru: <a href="https://news.google.com/" target="_blank"><b>Google
                                        News</b></a></i></h6>
                    </div>
                </article>

                <!--iklan dibawah artikel-->
                @include('partials.iklandibawahartikel')
                <!--iklan dibawah artikel end-->

                <!--tag-->
                <div class="my-4">
                    @foreach ($tags as $tag)
                        <button class="btn btn-sm text-lowercase my-1" style="background: #337ab7">
                            <a href="/tag/{{ $tag->id }}/{{ $tag->slug }}"
                                class="text-white text-decoration-none">{{ $tag->name }}</a>
                        </button>
                    @endforeach
                </div>
                <!--tag end-->

                <!--share-->
                @include('partials.share')
                <!--share end-->

                <h5 class="my-3">
                    <strong>Editor: {{ $artikel->user->name }}</strong>
                    <br>
                    <strong>Sumber: {{ $artikel->sumber }}</strong>
                </h5>
            </div>
            <!--Isi Artikel end-->

            <!-- Komentar -->
            <div id="disqus_thread" class="py-3 px-3 rounded"></div>
            <script>
                /**
                 *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                 *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */

                var disqus_config = function() {
                    this.page.url = "{{ url()->current() }}"; // Replace PAGE_URL with your page's canonical URL variable
                    this.page.identifier =
                        "{{ $artikel->slug }}"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                };

                (function() { // DON'T EDIT BELOW THIS LINE
                    var d = document,
                        s = d.createElement('script');
                    s.src = 'https://rlonetwork.disqus.com/embed.js';
                    s.setAttribute('data-timestamp', +new Date());
                    (d.head || d.body).appendChild(s);
                })();
            </>
            <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by
                    Disqus.</a></noscript>

            <!--Artikel Terkait-->
            <div class="col my-3 px-2 text-white" style="background-color: #ff4500; color: white">
                <h3>ARTIKEL TERKAIT</h3>
            </div>
            <div class="">
                @foreach ($related->take(5) as $artikel)
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
                                <small class="link text-uppercase fw-bold"><a
                                        class="text-danger font-size: 14px; text-decoration-none"
                                        href="/kategori/{{ $artikel->category->id }}/{{ $artikel->category->slug }}">{{ $artikel->category->name }}</a>
                                </small>
                                <!--<small class="text-center" style="font-size: 14px;"> |-->
                                <!--    {{ $artikel->published_at->diffForHumans() }}-->
                                <!--</small>-->
                            </h2>
                        </div>
                    </div>
                @endforeach
            </div>
            <!--Artikel Terkait end-->
        </div>

        <div class="col-md-4 offset-md">
            <!--Sidebar Artikel-->
            @include('partials.sidebarartikel')
            <!--Sidebar Artikel-->
        </div>
    </div>

    <!--content end-->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const paragraphs = document.querySelectorAll('.article-content p');
            const loadMoreBtn = document.querySelector('.load-more-btn');
    
            const paragraphsToShowInitially = 10; // Jumlah paragraf yang ditampilkan awalnya
            const paragraphsToShowMore = 10; // Jumlah paragraf yang ditampilkan setiap kali tombol "Load More" ditekan
            let currentParagraphs = paragraphsToShowInitially;
    
            // Fungsi untuk menampilkan atau menyembunyikan paragraf
            function showHideParagraphs() {
                paragraphs.forEach((paragraph, index) => {
                    if (index < currentParagraphs) {
                        paragraph.style.display = 'block';
                    } else {
                        paragraph.style.display = 'none';
                    }
                });
    
                // Menampilkan atau menyembunyikan tombol "load more" sesuai jumlah paragraf yang ditampilkan
                if (currentParagraphs < paragraphs.length) {
                    loadMoreBtn.style.display = 'block';
                } else {
                    loadMoreBtn.style.display = 'none';
                }
            }
    
            // Panggil fungsi untuk pertama kali tampilan halaman
            showHideParagraphs();
    
            // Fungsi untuk menangani klik tombol "load more"
            loadMoreBtn.addEventListener('click', function() {
                // Tampilkan lebih banyak paragraf saat tombol "Load More" ditekan
                currentParagraphs += paragraphsToShowMore;
                showHideParagraphs();
            });
        });
    </script>
@endsection
