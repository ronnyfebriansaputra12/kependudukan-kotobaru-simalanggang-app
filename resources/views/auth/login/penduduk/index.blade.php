@extends('layouts.auth.login.main')
@section('title', 'Login')
@section('container')

    <!-- /.login-logo -->
    <div class="card card-outline card-success">
        <div class="text-center mt-2 mb-3">
            <img src="{{ asset('AdminLTE') }}/dist/img/50kota.png" width="140px" height="130px" alt="">
        </div>

        <div class="text-center">
            <a href="{{ url('/') }}" class="h3"><b>Login Penduduk</b></a>
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
                        <a href="" onclick="openWhatsApp()">Lupa Password</a>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-success btn-block"><i class="fas fa-sign-in-alt"></i> Login</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        @php
            $nik = request()->segment(2);
        @endphp
        <input type="text" id="nik" value="{{ $nik }}" hidden>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    <script>
        function openWhatsApp() {
            // Ganti nomor WhatsApp, nama, dan NIK sesuai kebutuhan
            var waNumber = '6281374821410';
            var nama = ''; // Ganti dengan nama Anda
            var nik = document.getElementById('nik').value; // Get the value from the input field

            // Format pesan WhatsApp
            var message = encodeURIComponent('Permisi, saya lupa password akun \n NAMA : ' + nama + '\n NIK : ' + nik);

            // Membuka link WhatsApp dengan nomor dan pesan yang sudah diformat
            window.open('https://wa.me/' + waNumber + '?text=' + message, '_blank');
        }
    </script>


@endsection
