<!--ads header-->
<div class="container my-3">
    <div>
        @foreach ($ads->where('positionads_id', '1') as $ad)
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
<!--ads header end-->
