@extends('layouts.auth.login.main')
{{-- @extends('layouts.pencarian.main') --}}
@section('title', 'Login')
@section('container')

    <style>
        @media screen and (max-width: 780px) {
            img.img-logo {
                margin-bottom: 25px;
            }

            a.text-login {
                font-size: 25px;
                color: black;

            }
        }
    </style>
    <!-- /.login-logo -->
    <div class="card card-outline card-success">
        <div class="text-center mt-2 mb-3">
            <img src="{{ asset('AdminLTE') }}/dist/img/50kota.png" class="img-logo" width="140px" height="130px" alt="">
        </div>

        <div class="text-center">
            <a href="{{ url('/') }}" class="text-login h3"><b>Login Administrator</b></a>
        </div>
        <div class="card-body">
            <form action="/loginProsesAdmin" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                        placeholder="Password" value="{{ old('password') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-8">
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-success btn-block"><i class="fas fa-sign-in-alt"></i> Login</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    @include('sweetalert::alert')


@endsection
