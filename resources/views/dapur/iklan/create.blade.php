@extends('dapur.layouts.main')

@section('container')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="text-center">
                    <h4>Buat Iklan Baru</h4>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="my-3 mx-3">
            <form method="post" action="/dapur-imajinasi/ruangredaksi/iklan" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Iklan</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">
                            Nama iklan belum dibuat
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="positionads" class="form-label">Posisi iklan</label>
                    <select class="form-select" name="positionads_id">
                        @foreach ($positionads as $positionad)
                            @if (old('positionads_id') == $positionad->id)
                                <option value="{{ $positionad->id }}" selected>{{ $positionad->name }}</option>
                            @else
                                <option value="{{ $positionad->id }}">{{ $positionad->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="link" class="form-label">Link</label>
                    <input type="text" class="form-control" id="link" name="link" value="{{ old('link') }}">
                </div>

                <div class="mb-3">
                    <label for="script" class="form-label">Script</label>
                    <div>
                        <textarea class="form-control" id="script" name="script" value="{{ old('script') }}"></textarea>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status1" value="1">
                        <label class="form-check-label" for="status1">
                            Publish Yes
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status2" value="0" checked>
                        <label class="form-check-label" for="status2">
                            Publish No
                        </label>
                    </div>
                </div>

                <div class="my-3">
                    <label for="image" class="form-label">Gambar Iklan</label>
                    <img class="img-preview img-fluid mb-3 col-sm-3">
                    <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                        name="image" onchange="previewImage()">
                    @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <small style="color: blue">Gambar maksimal 200 kb (jpg,jpeg,png)</small>
                </div>

                <div class="mb-3">
                    <label for="caption" class="form-label">Caption</label>
                    <input type="text" class="form-control" id="caption" name="caption" value="{{ old('caption') }}">
                </div>

                <button type="submit" class="btn btn-success my-5">Buat Iklan</button>
            </form>
        </div>
    </section>
    <!-- /.content -->


    <!-- IMG Preview -->
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
@endsection
