<!--ads footer-->
<div class="container my-3">
    <div>
        @foreach ($ads->where('positionads_id', '2') as $ad)
            @if ($ad->image)
                <a href="{{ $ad->link }}" target="_blank" rel="dofollow">
                    <img src="{{ asset('storage/' . $ad->image) }}" alt="{{ $ad->name }}" class="img-fluid mb-3" /></a>
            @elseif ($ad->script)
                <script class="my-1">
                    {{ $ad->script }}
                </script>
            @endif
        @endforeach
    </div>
</div>
<!--ads footer end-->
