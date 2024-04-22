        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/dapur-imajinasi/ruangredaksi" class="brand-link text-decoration-none">
                @if ($icon)
                    <img src="{{ asset('storage/' . $icon) }}" alt="{{ $title }}"
                        class="brand-image img-size-50 img-circle
                    elevation-2" style="opacity: .8">
                @else
                    <img src="{{ asset('img') }}/icon-default.png" alt="{{ $title }}"
                        class="brand-image img-size-50 img-circle
                    elevation-2" style="opacity: .8">
                @endif
                <span class="brand-text font-weight-light">{{ $name }}</span>
            </a>
            <!-- Brand Logo end-->

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        @if (auth()->user()->image)
                            <img src="{{ asset('storage/' . auth()->user()->image) }}" alt="{{ auth()->user()->name }}"
                                class="brand-image rounded-circle my-1 elevation-2"
                                style="height: 35px; width: 35px;  object-fit: cover">
                        @else
                            <img src="{{ asset('img') }}/avatar.png" alt="{{ auth()->user()->name }}"
                                class="brand-image img-size-50 img-circle
                    elevation-2"
                                style="opacity: .8">
                        @endif
                    </div>
                    <div class="info">
                        <a href="/dapur-imajinasi/ruangredaksi/profil/{{ auth()->user()->username }}" target="_blank"
                            class="d-block text-decoration-none">{{ auth()->user()->name }}</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Cari"
                            aria-label="Cari">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2 mb-5">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="/dapur-imajinasi/ruangredaksi"
                                class="nav-link {{ Request::is('dapur-imajinasi/ruangredaksi') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>

                        <!-- Artikel Menu -->
                        <li class="nav-item">
                            <a href="#"
                                class="nav-link {{ Request::is('dapur-imajinasi/ruangredaksi/artikel*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-folder"></i>
                                <p>
                                    Artikel
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview bg-gray">
                                <li class="nav-item">
                                    <a href="/dapur-imajinasi/ruangredaksi/artikel"
                                        class="nav-link {{ Request::is('dapur-imajinasi/ruangredaksi/artikel') ? 'active' : '' }}">
                                        <i class="fas fa-file-lines nav-icon"></i>
                                        <p>Artikel Terpublish</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/dapur-imajinasi/ruangredaksi/artikel/create"
                                        class="nav-link {{ Request::is('dapur-imajinasi/ruangredaksi/artikel/create') ? 'active' : '' }}">
                                        <i class="fas fa-file-pen nav-icon"></i>
                                        <p>Buat Artikel</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/dapur-imajinasi/ruangredaksi/konsep"
                                        class="nav-link {{ Request::is('dapur-imajinasi/ruangredaksi/konsep') ? 'active' : '' }}">
                                        <i class="fas fa-file-circle-exclamation nav-icon"></i>
                                        <p>Konsep</p>
                                    </a>
                                </li>
                                @canany(['SuperAdmin', 'Admin', 'Editor'])
                                    <li class="nav-item">
                                        <a href="/dapur-imajinasi/ruangredaksi/jadwalposting"
                                            class="nav-link {{ Request::is('dapur-imajinasi/ruangredaksi/jadwalposting') ? 'active' : '' }}">
                                            <i class="fas fa-clock nav-icon"></i>
                                            <p>Artikel Terjadwal</p>
                                        </a>
                                    </li>
                                @endcanany
                                <li class="nav-item">
                                    <a href="/dapur-imajinasi/ruangredaksi/artikel/trash"
                                        class="nav-link {{ Request::is('dapur-imajinasi/ruangredaksi/artikel/trash') ? 'active' : '' }}">
                                        <i class="fas fa-trash nav-icon"></i>
                                        <p>Sampah</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- Galeri Menu -->
                        <li class="nav-item">
                            <a href="#"
                                class="nav-link {{ Request::is('dapur-imajinasi/ruangredaksi/image*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-photo-film"></i>
                                <p>
                                    Galeri
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview bg-gray">
                                <li class="nav-item">
                                    <a href="/dapur-imajinasi/ruangredaksi/image"
                                        class="nav-link {{ Request::is('dapur-imajinasi/ruangredaksi/image') ? 'active' : '' }}">
                                        <i class="fas fa-image nav-icon"></i>
                                        <p>Foto</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fas fa-video nav-icon"></i>
                                        <p>Video</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- Report Menu -->
                        <li class="nav-item">
                            <a href="#"
                                class="nav-link {{ Request::is('dapur-imajinasi/ruangredaksi/report*') ? 'active' : '' }}">
                                <i class="nav-icon fa-solid fa-chart-simple"></i>
                                <p>
                                    Report
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview bg-gray">
                                <li class="nav-item">
                                    <a href="/dapur-imajinasi/ruangredaksi/report/editor"
                                        class="nav-link {{ Request::is('dapur-imajinasi/ruangredaksi/report/editor') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-user-secret"></i>
                                        <p>Editor</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/dapur-imajinasi/ruangredaksi/report/author"
                                        class="nav-link {{ Request::is('dapur-imajinasi/ruangredaksi/report/author') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-user-tie"></i>
                                        <p>Penulis</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- Kontrol Admin Menu -->
                        <li class="nav-item">
                            <a href="/dapur-imajinasi/ruangredaksi/profil/{{ auth()->user()->username }}"
                                class="nav-link {{ Request::is('dapur-imajinasi/ruangredaksi/profil') ? 'active' : '' }}"
                                target="_blank">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Profil User
                                </p>
                            </a>
                        </li>

                        <div class="user-panel mt-3 justify-content-center">
                        </div>

                        @canany(['SuperAdmin', 'Admin', 'Editor'])
                            <!-- Admin Menu -->
                            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                                <div class="image">
                                    <img src="{{ asset('img') }}/setting.jpeg" alt="{{ $website->first()->domain }}"
                                        class="brand-image img-size-50 img-circle elevation-2" style="opacity: .8">
                                </div>
                                <div class="info text-white">
                                    <span>Admin Menu</span>
                                </div>
                            </div>
                            <!-- Kategori Menu -->
                            <li class="nav-item">
                                <a href="#"
                                    class="nav-link {{ Request::is('dapur-imajinasi/ruangredaksi/kategori*') ? 'active' : '' }}">
                                    <i class="fas fa-box-archive nav-icon"></i>
                                    <p>
                                        Kategori
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview bg-gray">
                                    <li class="nav-item">
                                        <a href="/dapur-imajinasi/ruangredaksi/kategori"
                                            class="nav-link {{ Request::is('dapur-imajinasi/ruangredaksi/kategori') ? 'active' : '' }}">
                                            <i class="fas fa-book nav-icon"></i>
                                            <p>Semua Kategori</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/dapur-imajinasi/ruangredaksi/kategori/trash"
                                            class="nav-link {{ Request::is('dapur-imajinasi/ruangredaksi/kategori/trash') ? 'active' : '' }}">
                                            <i class="fas fa-trash nav-icon"></i>
                                            <p>Sampah</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- Tag Menu -->
                            <li class="nav-item">
                                <a href="#"
                                    class="nav-link {{ Request::is('dapur-imajinasi/ruangredaksi/tag*') ? 'active' : '' }}">
                                    <i class="fas fa-tags nav-icon"></i>
                                    <p>
                                        Tag
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview bg-gray">
                                    <li class="nav-item">
                                        <a href="/dapur-imajinasi/ruangredaksi/tag"
                                            class="nav-link {{ Request::is('dapur-imajinasi/ruangredaksi/tag') ? 'active' : '' }}">
                                            <i class="fas fa-hashtag nav-icon"></i>
                                            <p>Semua tag</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/dapur-imajinasi/ruangredaksi/tag/trash"
                                            class="nav-link {{ Request::is('dapur-imajinasi/ruangredaksi/tag/trash') ? 'active' : '' }}">
                                            <i class="fas fa-trash nav-icon"></i>
                                            <p>Sampah</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- Iklan Menu -->
                            <li class="nav-item">
                                <a href="#"
                                    class="nav-link {{ Request::is('dapur-imajinasi/ruangredaksi/iklan*') ? 'active' : '' }}">
                                    <i class="fas fa-rectangle-ad nav-icon"></i>
                                    <p>
                                        Iklan
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview bg-gray">
                                    <li class="nav-item">
                                        <a href="/dapur-imajinasi/ruangredaksi/iklan"
                                            class="nav-link {{ Request::is('dapur-imajinasi/ruangredaksi/iklan') ? 'active' : '' }}">
                                            <i class="fas fa-rectangle-ad nav-icon"></i>
                                            <p>Semua Iklan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/dapur-imajinasi/ruangredaksi/iklan/trash"
                                            class="nav-link {{ Request::is('dapur-imajinasi/ruangredaksi/iklan/trash') ? 'active' : '' }}">
                                            <i class="fas fa-trash nav-icon"></i>
                                            <p>Sampah</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- Kiriman Pembaca Menu -->
                            <li class="nav-item">
                                <a href="#"
                                    class="nav-link {{ Request::is('dapur-imajinasi/ruangredaksi/kirimanpembaca*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-book-open-reader"></i>
                                    <p>
                                        Artikel Pembaca
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview bg-gray">
                                    <li class="nav-item">
                                        <a href="/dapur-imajinasi/ruangredaksi/kirimanpembaca"
                                            class="nav-link {{ Request::is('dapur-imajinasi/ruangredaksi/kirimanpembaca') ? 'active' : '' }}">
                                            <i class="nav-icon fas fa-envelopes-bulk"></i>
                                            <p>
                                                Semua Kiriman
                                            </p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- Data Pendaftar Menu -->
                            <li class="nav-item">
                                <a href="#"
                                    class="nav-link {{ Request::is('dapur-imajinasi/ruangredaksi/pendaftar*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-id-card"></i>
                                    <p>
                                        Data Pendaftar
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview bg-gray">
                                    <li class="nav-item">
                                        <a href="/dapur-imajinasi/ruangredaksi/pendaftar"
                                            class="nav-link {{ Request::is('dapur-imajinasi/ruangredaksi/pendaftar') ? 'active' : '' }}">
                                            <i class="nav-icon fas fa-users-rectangle"></i>
                                            <p>
                                                Semua Pendaftar
                                            </p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <div class="user-panel mt-3 justify-content-center">
                            </div>
                        @endcanany

                        @can('SuperAdmin')
                            <!-- Super Admin Menu -->
                            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                                <div class="image">
                                    <img src="{{ asset('img') }}/setting.jpeg" alt="{{ $website->first()->domain }}"
                                        class="brand-image img-size-50 img-circle elevation-2" style="opacity: .8">
                                </div>
                                <div class="info text-white">
                                    <span>Super Admin Menu</span>
                                </div>
                            </div>
                            <!-- Kontrol Menu -->
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-sitemap"></i>
                                    <p>
                                        Kontrol Menu
                                    </p>
                                </a>
                            </li>
                            <!-- Kontrol Admin Menu -->
                            <li class="nav-item">
                                <a href="#"
                                    class="nav-link {{ Request::is('dapur-imajinasi/ruangredaksi/useradmin*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user-group"></i>
                                    <p>
                                        Kontrol Admin
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview bg-gray">
                                    <li class="nav-item">
                                        <a href="/dapur-imajinasi/ruangredaksi/useradmin"
                                            class="nav-link {{ Request::is('dapur-imajinasi/ruangredaksi/useradmin') ? 'active' : '' }}">
                                            <i class="nav-icon fas fa-users"></i>
                                            <p>Semua User</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/dapur-imajinasi/ruangredaksi/useradmin/trash"
                                            class="nav-link {{ Request::is('dapur-imajinasi/ruangredaksi/useradmin/trash') ? 'active' : '' }}">
                                            <i class="fas fa-trash nav-icon"></i>
                                            <p>Sampah</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- Pengaturan Situs Menu -->
                            <li class="nav-item">
                                <a href="/dapur-imajinasi/ruangredaksi/website"
                                    class="nav-link {{ Request::is('dapur-imajinasi/ruangredaksi/website*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-globe"></i>
                                    <p>
                                        Pengaturan Web
                                    </p>
                                </a>
                            </li>
                            <!-- Info Redaksi Menu -->
                            <li class="nav-item">
                                <a href="#"
                                    class="nav-link {{ Request::is('dapur-imajinasi/ruangredaksi/info*') ? 'active' : '' }}">
                                    <i class="fas fa-circle-info nav-icon"></i>
                                    <p>
                                        Info Redaksi
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview bg-gray">
                                    <li class="nav-item">
                                        <a href="/dapur-imajinasi/ruangredaksi/info"
                                            class="nav-link {{ Request::is('dapur-imajinasi/ruangredaksi/info') ? 'active' : '' }}">
                                            <i class="fas fa-circle-info nav-icon"></i>
                                            <p>Semua Info</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/dapur-imajinasi/ruangredaksi/info/trash"
                                            class="nav-link {{ Request::is('dapur-imajinasi/ruangredaksi/info/trash') ? 'active' : '' }}">
                                            <i class="fas fa-trash nav-icon"></i>
                                            <p>Sampah</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endcan

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
