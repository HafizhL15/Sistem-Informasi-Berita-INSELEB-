<!--header start-->
<div class="sticky-top">
    <!--Top Header-->
    <nav class="navbar" style="background-color: #f3beaa">
        <div class="container" style="max-width: 1080px">
            <a class="navbar-brand img-fluid" href="/">
                {{-- <img src="{{ asset('storage/' . $icon) }}" alt="{{ $name }}"> --}}
                @foreach ($website as $site)
                    @if ($site->image)
                        <img src="{{ asset('storage/' . $site->image) }}" alt="{{ $name }}">
                    @else
                        <img src="{{ asset('img') }}/ins.webp" alt="{{ $name }}">
                    @endif
                @endforeach
            </a>
            {{-- button network --}}
            <div class="dropdown">
                <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="networkDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i><b>Network </b></i><i class="fa-solid fa-globe"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="networkDropdown">
                    <li><a class="dropdown-item" href="https://daunlebar.com"><b>DAUN LEBAR</b></a></li>
                    <li><a class="dropdown-item" href="https://literasiberita.com"><b>LITERASI BERITA</b></a></li>
                    {{-- <li><a class="dropdown-item" href="#">Radar Lampung Disway</a></li> --}}
                </ul>
            </div>

            {{-- searchbar --}}
            <form class="d-flex d-none d-lg-block d-md-block my-2 mx-2" style="width: 50%" action="/cari-artikel">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari Artikel" name="search"
                        aria-label="cari" value="{{ request('search') }}" />
                    <button class="btn" style="background-color: #FF4500; color: white" type="submit"><i
                            class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>

            <button class="btn" style="background-color: #FF4500; color: white" type="button"
                data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions"
                aria-controls="offcanvasWithBothOptions"><i class="fa-solid fa-pen-to-square fa-3xl"></i>
            </button>

            {{-- button close --}}

            <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions"
                aria-labelledby="offcanvasWithBothOptionsLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">{{ $name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>

                {{-- navbar slide sebelah kanan kirim artikel --}}
                <div class="offcanvas-body">
                    <form class="d-flex my-3 d-md-none justify-content-center" action="/cari-artikel">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Cari Artikel" name="search"
                                aria-label="cari" value="{{ request('search') }}" />
                            <button class="btn" type="submit" style="background-color: #FF4500; color: white"><i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>
                    <div class="navbar">
                        <a class="nav-link text-muted" href="/daftar-penulis"><i
                                class="fa-solid fa-user-plus fa-3xl"></i>
                            Gabung Penulis</a>
                    </div>
                    <div class="navbar">
                        <a class="nav-link text-muted" href="/kirim-artikel"><i
                                class="fa-solid fa-newspaper fa-3xl"></i>
                            Kirim Artikel </a>
                    </div>
                    {{-- <div class="navbar">
                        <a class="nav-link text-muted" href="/network"><i class="fa-solid fa-newspaper fa-3xl"></i>
                            Network</a>
                    </div> --}}
                    
                    <div class="text-center my-4">
                        <a class="navbar-brand img-fluid" href="/">
                            @foreach ($website as $site)
                                @if ($site->image)
                                    <img src="{{ asset('storage/' . $site->image) }}" alt="{{ $name }}">
                                @else
                                    <img src="{{ asset('img') }}/ins.webp" alt="{{ $name }}">
                                @endif
                            @endforeach
                        </a>
                    </div>
                    <div class="text-center my-2">
                        <p class="mb-3">
                            <a href="{{ $facebook }}" target="_blank" class="align-items-center"
                                style="color: #4267B2"><i class="fa-brands fa-square-facebook fa-2xl mx-1"></i></a>
                            <a href="{{ $twitter }}" target="_blank" class="align-items-center"
                                style="color: #1DA1F2"><i class="fa-brands fa-square-twitter fa-2xl mx-1"></i></a>
                            <a href="{{ $instagram }}" target="_blank" class="align-items-center"
                                style="color: #E1306C"><i class="fa-brands fa-instagram fa-2xl mx-1"></i></a>
                            <a href="{{ $youtube }}" target="_blank" class="align-items-center"
                                style="color: #FF0000"><i class="fa-brands fa-youtube fa-2xl mx-1"></i></a>
                            <a href="{{ $tiktok }}" target="_blank" class="align-items-center"
                                style="color: #000000"><i class="fa-brands fa-tiktok fa-2xl mx-1"></i></a>
                        </p>
                    </div>
                </div>
                {{-- batas --}}


            </div>
        </div>
    </nav>
    <!--Top Header end-->
    <!--top menu-->
    <nav class="shadow-lg text-uppercase text-white" style="background-color: #FF4500">
        <div class="container" style="max-width: 1080px">
            <ul class="scrollmenu">
                <li><img src="{{ asset('img') }}/ins.webp" alt="{{ $name }}" width="84" height="35"></li>
                {{-- <li><a href="/">News</a></li> --}}
                {{-- ini gw ubah category yang tadinya categories as kategori --}}
                @foreach ($categories as $kategori)
                    <li><a href="/kategori/{{ $kategori->id }}/{{ $kategori->slug }}">{{ $kategori->name }}</a>
                    </li>
                @endforeach
                <li><a href="/indeks">Indeks</a></li>
                

                {{-- <li>
                    <a class="dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Gabung Penulis
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-uppercase" style="font-size: 14px">
                        <li><a class="dropdown-item" href="/daftar-penulis">Daftar</a></li>
                        <li><a class="dropdown-item" href="/kirim-artikel">Kirim Artikel</a></li>
                    </ul>
                </li> --}}
                <li>
                    <button class="btn" type="submit" style="background-color: #FF4500; color: white" ype="button"
                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions"aria-controls="offcanvasWithBothOptions"><i
                        class="fa-solid fa-magnifying-glass"></i></button>
                </li>                
            </ul>
        </div>
    </nav>
    <!--top menu end-->
</div>
<!--header end-->
