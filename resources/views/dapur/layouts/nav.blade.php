<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav ms-2">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto mr-2">
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline" action="/dapur-imajinasi/ruangredaksi/cari-artikel">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="text" placeholder="Cari Artikel"
                            name="search" aria-label="cari" value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>
        <!-- Navbar Search End-->
        <!-- Dropdown Menu -->
        <div class="btn-group">
            <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <a href="/dapur-imajinasi/ruangredaksi/profil/{{ auth()->user()->username }}" target="_blank"
                    class="dropdown-item">
                    <!-- Profil Start -->
                    <div class="media">
                        @if (auth()->user()->image)
                            <img src="{{ asset('storage/' . auth()->user()->image) }}" alt="{{ auth()->user()->name }}"
                                class="brand-image rounded-circle my-1 elevation-2 mr-3"
                                style="height: 50px; width: 50px;  object-fit: cover">
                        @else
                            <img src="{{ asset('img') }}/avatar.png" alt="{{ auth()->user()->name }}"
                                class="brand-image img-size-50 img-circle
                    elevation-2 mr-3"
                                style="opacity: .8">
                        @endif
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                {{ auth()->user()->name }}
                            </h3>
                            <p class="text-sm">{{ $rolenavbar }}</p>
                        </div>
                    </div>
                    <!-- Profil End -->
                </a>
                <hr class="dropdown-divider">
                <form action="/logout" method="post">
                    @csrf
                    <button type="submit" class="dropdown-item">
                        <i class="nav-icon fas fa-right-from-bracket"></i> Logout
                    </button>
                </form>
            </ul>
        </div>
        <!-- Dropdown Menu End -->
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
