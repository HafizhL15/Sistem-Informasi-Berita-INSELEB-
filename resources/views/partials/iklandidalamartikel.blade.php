<!--ads didalam artikel-->
<div class="text-center mt-3 mb-1 px-3 fw-bold text-uppercase">
    <small>Advertisements</small>
</div>
<div>
    @foreach ($ads->where('positionads_id', '13') as $ad)
        @if ($ad->image)
            <a href="{{ $ad->link }}" target="_blank" rel="dofollow">
                <img src="{{ asset('storage/' . $ad->image) }}" alt="{{ $ad->name }}" class="img-fluid mb-3" /></a>
        @elseif ($ad->script)
            <div>
                {!! $ad->script !!}
            </div>
        @endif
    @endforeach
</div>
<!--ads didalam artikel end-->
