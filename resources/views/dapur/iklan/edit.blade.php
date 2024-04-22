@extends('dapur.layouts.main')

@section('container')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="text-center">
                    <h4>Edit Iklan</h4>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="my-3 mx-3">
            <form method="post" action="/dapur-imajinasi/ruangredaksi/iklan/{{ $iklan->id }}"
                enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Iklan</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name', $iklan->name) }}">
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
                            @if (old('positionads_id', $iklan->positionads_id) == $positionad->id)
                                <option value="{{ $positionad->id }}" selected>{{ $positionad->name }}</option>
                            @else
                                <option value="{{ $positionad->id }}">{{ $positionad->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="link" class="form-label">Link</label>
                    <input type="text" class="form-control" id="link" name="link"
                        value="{{ old('link', $iklan->link) }}">
                </div>

                <div class="mb-3">
                    <label for="script" class="form-label">Script</label>
                    <div>
                        <textarea class="form-control" id="script" name="script">{{ old('script', $iklan->script) }}</textarea>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <div class="form-check" name="status" type="radio" id="status1">
                        <input class="form-check-input" name="status" value="1" <?php if ($iklan->status == '1') {
                            echo 'checked';
                        } ?> type="radio"
                            for="status1">Publish
                        Yes</input>
                    </div>
                    <div class="form-check" name="status" type="radio" id="status2">
                        <input class="form-check-input" name="status" value="0" <?php if ($iklan->status == '0') {
                            echo 'checked';
                        } ?> type="radio"
                            for="status2">Publish No</input>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Gambar Iklan</label>
                    <input type="hidden" name="oldImage" value="{{ $iklan->image }}">
                    @if ($iklan->image)
                        <img src="{{ asset('storage/' . $iklan->image) }}"
                            class="img-preview img-fluid mb-3 col-sm-3 d-block">
                    @else
                        <img class="img-preview img-fluid mb-3 col-sm-3">
                    @endif

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
                    <input type="text" class="form-control" id="caption" name="caption"
                        value="{{ old('caption', $iklan->caption) }}">
                </div>

                <button type="submit" class="btn btn-success my-5">Edit Iklan</button>
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
