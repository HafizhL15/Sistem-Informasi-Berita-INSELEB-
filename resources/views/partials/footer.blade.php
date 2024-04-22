<!--footer-->
<div class="row" style="background-color: #ff4500; max-height: 3px"></div>
<div class="row" style="background-color: #f3beaa">
    <footer class="my-4">
        <div class="text-center mt-2 mb-4">
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
                <a href="{{ $facebook }}" target="_blank" class="align-items-center" style="color: #4267B2"><i
                        class="fa-brands fa-square-facebook fa-2xl mx-1"></i></a>
                <a href="{{ $twitter }}" target="_blank" class="align-items-center" style="color: #1DA1F2"><i
                        class="fa-brands fa-square-twitter fa-2xl mx-1"></i></a>
                <a href="{{ $instagram }}" target="_blank" class="align-items-center" style="color: #E1306C"><i
                        class="fa-brands fa-instagram fa-2xl mx-1"></i></a>
                <a href="{{ $youtube }}" target="_blank" class="align-items-center" style="color: #FF0000"><i
                        class="fa-brands fa-youtube fa-2xl mx-1"></i></a>
                <a href="{{ $tiktok }}" target="_blank" class="align-items-center" style="color: #000000"><i
                        class="fa-brands fa-tiktok fa-2xl mx-1"></i></a>
            </p>
        </div>


        <ul class="nav justify-content-center">
            <li class="nav-item"><a href="/tentang-kami" class="nav-link px-2 text-muted">Tentang
                    Kami</a></li>
            <li class="nav-item"><a href="/redaksi" class="nav-link px-2 text-muted">Redaksi</a></li>
            <li class="nav-item"><a href="/kontak" class="nav-link px-2 text-muted">Kontak</a></li>
            <li class="nav-item"><a href="/pedoman-siber" class="nav-link px-2 text-muted">Pedoman
                    Siber</a></li>
            <li class="nav-item"><a href="/privacy-policy" class="nav-link px-2 text-muted">Privacy
                    Policy</a></li>
        </ul>
        <div class="text-center mt-4">
            <h5 class="text-muted">Copyright &copy; 2023 {{ $name }}.
                All right reserved</h5>
        </div>
    </footer>
</div>
<!--footer end-->

<!-- Fontawesome -->
<script src="https://kit.fontawesome.com/87332d9f3a.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>
    function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>

{!! $meta_footer !!}

<!-- Summernote -->
<script src="{{ asset('assets') }}/plugins/summernote/summernote-bs5.js"></script>

<!-- teks editor summernote-->
<script>
    $(document).ready(function() {
        // Summernote
        $('#summernote').summernote({
            placeholder: "Tulis Artikel ...",
            height: 250,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
                ['font', ['fontname', 'fontsize', 'strikethrough', 'superscript', 'subscript']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['misc', ['fullscreen', 'codeview', 'undo', 'redo']],
            ],
            onpaste: function(e) {
                var bufferText = ((e.originalEvent || e).clipboardData || window
                    .clipboardData).getData('Text');
                e.preventDefault();
                setTimeout(function() {
                    document.execCommand('insertText', false, bufferText);
                    $(this).parent().siblings('#summernote').destroy();
                }, 10);
            }
        });
    })
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js"
    integrity="sha512-jNDtFf7qgU0eH/+Z42FG4fw3w7DM/9zbgNPe3wfJlCylVDTT3IgKW5r92Vy9IHa6U50vyMz5gRByIu4YIXFtaQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        $('img').lazyload();
    })
</script>

<!-- Codesample -->
<script src="{{ asset('vendor/prism.js') }}"></script>

<!-- JS Socials -->
<script src="{{ asset('assets') }}/plugins/jssocials/jssocials.min.js"></script>
@stack('script')
