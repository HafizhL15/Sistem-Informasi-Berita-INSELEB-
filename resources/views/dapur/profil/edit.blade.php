@extends('dapur.layouts.main')

@section('container')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="text-center">
                    <h4>Edit User : {{ auth()->user()->name }}</h4>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="my-3 mx-3">
            <form method="post" action="/dapur-imajinasi/ruangredaksi/profil/{{ auth()->user()->id }}"
                enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name', auth()->user()->name) }}">
                    @error('name')
                        <div class="invalid-feedback">
                            Nama lengkap belum diisi
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                        name="username" minlength="5" value="{{ old('username', auth()->user()->username) }}">
                    @error('username')
                        <div class="invalid-feedback">
                            Username minimal 5 karakter / Username belum diisi
                        </div>
                    @enderror
                    <small style="color: blue">Minimal 5 Karakter</small>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" value="{{ old('email', auth()->user()->email) }}">
                    @error('email')
                        <div class="invalid-feedback">
                            Email salah / belum diisi
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Telpon</label>
                    <input type="number" class="form-control @error('phone') is-invalid @enderror" id="phone"
                        name="phone" minlength="10" maxlength="13" value="{{ old('phone', auth()->user()->phone) }}">
                    @error('phone')
                        {{-- <small style="color: red">{{ $message }}</small> --}}
                        <div class="invalid-feedback">
                            Nomor telepon belum diisi / nomor telepon minimal 10 angka, maksimal 13 angka
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Alamat</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                        name="address" value="{{ old('address', auth()->user()->address) }}">
                    @error('address')
                        <div class="invalid-feedback">
                            Alamat belum diisi
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Foto Profil</label>
                    <input type="hidden" name="oldImage" value="{{ auth()->user()->image }}">
                    @if (auth()->user()->image)
                        <img src="{{ asset('storage/' . auth()->user()->image) }}"
                            class="img-preview img-fluid mb-3 col-sm-3 d-block">
                    @else
                        <img class="img-preview img-fluid mb-3 col-sm-3">
                    @endif
                    <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                        name="image" onchange="previewImage()">
                    @error('image')
                        <div class="invalid-feedback">
                            Gambar maksimal 200 kb (jpg,jpeg,png) / gambar belum diupload
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success my-5">Edit User</button>
            </form>
        </div>


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

    </section>
    <!-- /.content -->
@endsection
