@extends('dapur.layouts.main')

@section('container')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="text-center">
                    <h4>Edit Password User</h4>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="text-center">
            @if ($useradmin->image)
                <img src="{{ asset('storage/' . $useradmin->image) }}" alt="{{ $useradmin->name }}"
                    class="img-size-50 img-fluid img-circle my-1">
            @else
                <img src="{{ asset('img/avatar.png') }}" alt="{{ $useradmin->name }}"
                    class="img-size-64 img-fluid img-circle my-1">
            @endif
        </div>
        <h5 class="my-3 text-center">{{ $useradmin->name }}</h5>

        <div class="my-3 mx-3">
            <form method="post" action="/dapur-imajinasi/ruangredaksi/useradmin/editpassword/{{ $useradmin->id }}"
                enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="password" class="form-label">Password Baru</label>
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
                <button type="submit" class="btn btn-success my-5">Edit Password User</button>
            </form>
        </div>




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
