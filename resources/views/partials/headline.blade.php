<div id="carouselHeadlineInterval" class="carousel slide" data-bs-ride="carousel" data-bs-touch="true">
    <!-- Indicators/dots -->
    {{-- <div class="carousel-indicators">
        @foreach ($headline as $key => $artikel)
            @if ($key == 0)
                <button class="{{ $key == 0 ? 'active' : '' }}" type="button" data-bs-target="#carouselHeadlineInterval"
                    data-bs-slide-to="0">
                </button>
            @else
                <button class="{{ $key == 0 ? 'active' : '' }}" type="button" data-bs-target="#carouselHeadlineInterval"
                    data-bs-slide-to="{{ $key }}">
                </button>
            @endif
        @endforeach
    </div> --}}
    <!-- The slideshow/carousel -->
    <div class="carousel-inner">
        @foreach ($headline as $key => $artikel)
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" data-bs-interval="7000">
                @if ($artikel->image)
                    <a href="/artikel/rlo-{{ $artikel->id }}/{{ $artikel->slug }}">
                        <img src="{{ $artikel->image }}" alt="{{ $artikel->title }}" class="d-block headline-img">
                    </a>
                @else
                    <a href="/artikel/rlo-{{ $artikel->id }}/{{ $artikel->slug }}">
                        <img src="{{ asset('img') }}/content.jpg" alt="{{ $artikel->title }}"
                            class="d-block headline-img">
                    </a>
                @endif
                <div class="carousel-caption-head">
                    <div class="me-1">
                        <a class="link text-decoration-none text-white fw-bold"
                            href="/artikel/rlo-{{ $artikel->id }}/{{ $artikel->slug }}">
                            <h1>{{ $artikel->title }}</h1>
                        </a>
                    </div>
                    <div class="text-decoration-none text-white mb-3 me-1" style="font-size: 12px">
                        {{ $artikel->published_at->translatedFormat('l, d M Y - H:i') }} WIB
                    </div>
                </div>
            </div>
            <div class="position-absolute px-3 py-3 text-white fw-bold" style="background-color: #ff4500">
                HEADLINE</div>
        @endforeach
    </div>

    <!-- Left and right controls/icons -->
    {{-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselHeadlineInterval"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselHeadlineInterval"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button> --}}
</div>
