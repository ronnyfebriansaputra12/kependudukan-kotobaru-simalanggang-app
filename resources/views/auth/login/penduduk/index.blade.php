@extends('layouts.auth.login.main')
@section('title', 'Login')
@section('container')

    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="text-center mt-2">
            <img src="{{ asset('AdminLTE') }}/dist/img/50kota.png" width="140px" height="130px" alt="">
        </div>

        <div class="text-center">
            <a href="{{ url('/') }}" class="h1"><b>Login Penduduk</b></a>
        </div>
        <div class="card-body">
            <form action="/loginProsesPenduduk" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror"
                        value="{{ old('password', $penduduk->nik) }}" placeholder="NIK">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('nik')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                        placeholder="Password" value="{{ old('password', 123456) }}">
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
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
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
