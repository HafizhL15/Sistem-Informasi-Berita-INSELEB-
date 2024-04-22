@extends('dapur.layouts.main')

@section('container')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="text-center">
                    <h4>Buat User Baru</h4>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="my-3 mx-3">
            <form method="post" action="/dapur-imajinasi/ruangredaksi/useradmin" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">
                            Nama lengkap belum diisi
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                        name="username" minlength="5" value="{{ old('username') }}">
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
                        name="email" value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">
                            Email salah / belum diisi
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                            name="password" minlength="5">
                        <button class="btn btn-outline-secondary" type="button" id="showPassword"><i
                                class="fas fa-eye"></i></button>

                        @error('password')
                            {{-- <small style="color: red" class="d-block">{{ $message }}</small> --}}
                            <div class="invalid-feedback">
                                Password belum diisi / password minimal 5 karakter
                            </div>
                        @enderror
                    </div>
                    <small style="color: blue">Minimal 5 Karakter</small>
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                            id="password_confirmation" name="password_confirmation" minlength="5">
                        <button class="btn btn-outline-secondary" type="button" id="showPasswordConfirmation"><i
                                class="fas fa-eye"></i></button>

                        @error('password_confirmation')
                            {{-- <small style="color: red" class="d-block">{{ $message }}</small> --}}
                            <div class="invalid-feedback">
                                Konfirmasi Password belum diisi / Harus sama dengan Password
                            </div>
                        @enderror
                    </div>
                    <small style="color: blue">Harus sama dengan Password</small>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Telpon</label>
                    <input type="number" class="form-control @error('phone') is-invalid @enderror" id="phone"
                        name="phone" minlength="10" maxlength="13" value="{{ old('phone') }}">
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
                        name="address" value="{{ old('address') }}">
                    @error('address')
                        <div class="invalid-feedback">
                            Alamat belum diisi
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="user" class="form-label">Otorisasi Admin</label>
                    <select class="form-select" name="role_id">
                        @foreach ($roles as $userrole)
                            @if (old('role_id') == $userrole->id)
                                <option value="{{ $userrole->id }}" selected>{{ $userrole->role }}</option>
                            @else
                                <option value="{{ $userrole->id }}">{{ $userrole->role }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Foto Profil</label>
                    <img class="img-preview img-fluid mb-3 col-sm-3">
                    <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                        name="image" onchange="previewImage()">
                    @error('image')
                        <div class="invalid-feedback">
                            Gambar maksimal 200 kb (jpg,jpeg,png) / gambar belum diupload
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success my-5">Tambah User</button>
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

        <script>
            //show password
            const buttonPassword = document.querySelector('#showPassword');
            const password = document.querySelector('#password');

            buttonPassword.addEventListener('click', function(e) {
                // button the type attribute
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                // button the eye slash icon
                this.classList.button('fa-eye-slash');
            });

            //show confirm password
            const verifPassword = document.querySelector('#showPasswordConfirmation');
            const passwordConfirmation = document.querySelector('#password_confirmation');

            verifPassword.addEventListener('click', function(e) {
                // button the type attribute
                const type = passwordConfirmation.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordConfirmation.setAttribute('type', type);
                // button the eye slash icon
                this.classList.button('fa-eye-slash');
            });
        </script>

    </section>
    <!-- /.content -->
@endsection
