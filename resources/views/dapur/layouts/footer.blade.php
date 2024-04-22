        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.0.0
            </div>
            <strong>Copyright &copy; 2023 <a class="text-decoration-none" href="/">{{ $domain }}</a>.</strong>
            All rights
            reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        <script src="{{ asset('assets') }}/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('assets') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('assets') }}/dist/js/adminlte.min.js"></script>
        <!-- Summernote -->
        <script src="{{ asset('assets') }}/plugins/summernote/summernote-bs5.js"></script>
        <!-- CodeMirror -->
        <script src="{{ asset('assets') }}/plugins/codemirror/codemirror.js"></script>
        <script src="{{ asset('assets') }}/plugins/codemirror/mode/css/css.js"></script>
        <script src="{{ asset('assets') }}/plugins/codemirror/mode/xml/xml.js"></script>
        <script src="{{ asset('assets') }}/plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>
        <!-- Select2 -->
        {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
        <script src="{{ asset('js') }}/style.tag.js"></script>
        <script src="{{ asset('js') }}/listgambar.js"></script>

        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"
            integrity="sha512-9UR1ynHntZdqHnwXKTaOm1s6V9fExqejKvg5XMawEMToW4sSw+3jtLrYfZPijvnwnnE8Uol1O9BcAskoxgec+g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}

        <!-- teks editor -->
        <script>
            $(document).ready(function() {
                // Summernote
                $('#summernote').summernote({
                    height: 480,
                    codeviewFilter: true,
                    codeviewIframeFilter: false,
                    toolbar: [
                        // [groupName, [list of button]]
                        ['style', ['style', 'bold', 'italic', 'clear']],
                        ['font', ['fontname', 'fontsize', 'strikethrough', 'superscript', 'subscript']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'imageList', 'video']],
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
                    // dialogsInBody: true,
                    // imageList: {
                    //     endpoint: "{{ URL::to('DapurArtikelController/listGambar') }}";
                    // endpoint: "<?php echo url('DapurArtikelController/listGambar'); ?>";
                    // fullUrlPrefix: "<?php echo url('storage/gambar-upload'); ?>";
                    // }
                });


                // CodeMirror
                CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
                    mode: "htmlmixed",
                    theme: "monokai"
                });
            })
        </script>

        <!-- TinyMCE -->
        <script src="https://cdn.tiny.cloud/1/kar9od5bho9m6n9ci0cfk27z37wiahgfuacfwrf0c33922wb/tinymce/5/tinymce.min.js"
            referrerpolicy="origin"></script>
        <script>
            var editor_config = {
                path_absolute: "/",
                selector: 'textarea.my-editor',
                relative_urls: false,
                plugins: [
                    "advlist autolink autosave codesample lists link image charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars code fullscreen",
                    "insertdatetime media nonbreaking save table directionality",
                    "emoticons template paste textpattern"
                ],
                toolbar: "restoredraft insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | codesample",
                file_picker_callback: function(callback, value, meta) {
                    var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName(
                        'body')[0].clientWidth;
                    var y = window.innerHeight || document.documentElement.clientHeight || document
                        .getElementsByTagName('body')[0].clientHeight;

                    var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
                    if (meta.filetype == 'image') {
                        cmsURL = cmsURL + "&type=Images";
                    } else {
                        cmsURL = cmsURL + "&type=Files";
                    }

                    tinyMCE.activeEditor.windowManager.openUrl({
                        url: cmsURL,
                        title: 'Filemanager',
                        width: x * 0.8,
                        height: y * 0.8,
                        resizable: "yes",
                        close_previous: "no",
                        onMessage: (api, message) => {
                            callback(message.content);
                        }
                    });
                }
            };

            tinymce.init(editor_config);
        </script>

        <script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>

        <script>
            var route_prefix = "/filemanager";
            $('#lfm').filemanager('image', {
                prefix: route_prefix
            });
        </script>

        <!-- Codesample -->
        <script src="{{ asset('vendor/prism.js') }}"></script>
