<!--maind sidebar 1-->
<!--iklan sidebar 1-->
@include('partials.iklansidebar1')
<!--iklan sidebar 1 end-->
<div class="col mt-4 px-2 text-uppercase" style="background-color: #ff4500; color: white">
    <h3>ARTIKEL POPULER</h3>
</div>
<!--artikel terpopuler-->
<div>
    @foreach ($populer as $artikel)
        <ol class="list-group">
            <li class="border-bottom d-flex justify-content-center align-items-center">
                <h2>
                    <span class="fw-bold">#{{ $loop->iteration }}</span>
                </h2>
                <div class="my-3 mx-3 me-auto">
                    <h2>
                        <a class="link text-decoration-none text-dark"
                            href="/artikel/rlo-{{ $artikel->id }}/{{ $artikel->slug }}">{{ $artikel->title }}
                        </a>
                    </h2>
                </div>
            </li>
        </ol>
    @endforeach
</div>
<!--artikel terpopuler end-->
<!--iklan sidebar 2-->
@include('partials.iklansidebar2')
<!--iklan sidebar 2 end-->
<div class="col my-3 px-2 text-uppercase" style="background-color: #ff4500; color: white">
    <h3>REKOMENDASI ARTIKEL</h3>
</div>
<!--rekomendasi artikel-->
@foreach ($rekomendasi as $artikel)
    <div class="col d-flex my-2 border-bottom">
        @if ($artikel->image)
            <a href="/artikel/rlo-{{ $artikel->id }}/{{ $artikel->slug }}">
                <img src="{{ $artikel->image }}" alt="{{ $artikel->title }}" class="me-2 sidebar-img">
            </a>
        @else
            <a href="/artikel/rlo-{{ $artikel->id }}/{{ $artikel->slug }}">
                <img src="{{ asset('img') }}/content.jpg" alt="{{ $artikel->title }}" class="me-2 sidebar-img">
            </a>
        @endif
        <div class="">
            <h2>
                <a class="link text-decoration-none text-dark text-responsive"
                    href="/artikel/rlo-{{ $artikel->id }}/{{ $artikel->slug }}">
                    {{ $artikel->title }}
                </a>
                <br>
                <small class="link text-uppercase fw-bold"><a class="text-danger text-decoration-none"
                        href="/kategori/{{ $artikel->category->id }}/{{ $artikel->category->slug }}">{{ $artikel->category->name }}</a>
                </small>
            </h2>
        </div>
    </div>
@endforeach
<!--rekomendasi artikel end-->
<!--iklan sidebar 3-->
@include('partials.iklansidebar3')
<!--iklan sidebar 3 end-->
<!--main sidebar 1 end-->
