<!--ads dibawah header-->
<div class="container my-3">
    <div class="text-center mb-1 px-3 fw-bold text-uppercase">
        <small>Advertisements</small>
    </div>
    <div>
        @foreach ($ads->where('positionads_id', '3') as $ad)
            @if ($ad->image)
                <a href="{{ $ad->link }}" target="_blank" rel="dofollow">
                    <img src="{{ asset('storage/' . $ad->image) }}" alt="{{ $ad->name }}" class="img-fluid mb-3" /></a>
            @elseif ($ad->script)
                <div class="my-1">
                    {!! $ad->script !!}
                </div>
            @endif
        @endforeach
    </div>
</div>
<!--ads dibawah header end-->
