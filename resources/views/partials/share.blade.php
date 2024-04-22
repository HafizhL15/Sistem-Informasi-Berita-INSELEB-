<div class="my-3">
    <strong>Bagikan: </strong>
    <div class="share fa-xs"></div>
</div>

@push('script')
    <script>
        $(document).ready(function() {
            $(".share").jsSocials({
                url: "{{ url()->current() }}",
                text: "{{ $title }}",
                logo: "{{ $artikel->image }}",
                // showLabel: true,
                shares: [{
                    share: 'facebook',
                    label: 'Facebook'
                }, 'twitter', 'whatsapp', 'telegram']
            });
        });
    </script>
@endpush
