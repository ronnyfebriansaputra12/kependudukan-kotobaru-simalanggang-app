@extends('layouts.master')
@section('title', 'Tambah Penduduk')
@section('header', ' Form Tambah Data Penduduk')
@section('link')
<a href="{{ url('penduduk') }}">Penduduk</a>
@endsection
@section('breadcrumb', 'Tambah Penduduk')

@section('container-fluid')
<!-- Loading Modal -->
<div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="loadingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <div class="spinner-border text-success" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <p class="mt-2">Menambahkan Data Penduduk...</p>
            </div>
        </div>
    </div>
</div>


<div class="container">

    <div class="card">
        <div class="card-body">
            <form action="{{ url('penduduk') }}" method="post" class="needs-validation" novalidate id="pendudukForm">
                @csrf
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="uid" class="form-label">UID</label>
                                <input type="number" class="form-control @error('uid') is-invalid @enderror" id="uid" value="{{ old('uid') }}" name="uid" autofocus required>
                                @error('uid')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="nik" class="form-label">NIK</label>
                                <input type="number" class="form-control @error('nik') is-invalid @enderror" id="nik" value="{{ old('nik') }}" name="nik" placeholder="Nomor NIK Anda" autofocus required>
                                @error('nik')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="no_kk" class="form-label">Nomor KK</label>
                                <input type="number" class="form-control @error('no_kk') is-invalid @enderror" id="no_kk" value="{{ old('no_kk') }}" name="no_kk" placeholder="Nomor KK Anda" autofocus required>
                                @error('no_kk')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" value="{{ old('nama') }}" name="nama" placeholder="Masukkan nama Anda" autofocus required>
                            </div>
                            @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror" id="pekerjaan" value="{{ old('pekerjaan') }}" name="pekerjaan" placeholder="pekerjaan Anda" autofocus required>
                            </div>
                            @error('pekerjaan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" value="123456" name="password" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label">Password Confirmation</label>
                                <input type="password" class="form-control" id="password_confirmation" value="123456" name="password_confirmation" readonly>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="tmp_lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control @error('tmp_lahir') is-invalid @enderror" id="tmp_lahir" value="{{ old('tmp_lahir') }}" name="tmp_lahir" placeholder="Tempat Lahir" autofocus required>
                            </div>
                            @error('tmp_lahir')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" id="tgl_lahir" value="{{ old('tgl_lahir') }}" name="tgl_lahir" placeholder="Tanggal Lahir" autofocus required>
                            </div>
                            @error('tgl_lahir')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="jekel" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" required name="jekel" aria-label="Default select example">
                                    <option selected>Jenis Kelamin</option>
                                    <option value="Laki-laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                @error('jekel')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="ibu_kandung" class="form-label">Nama Ibu Kandung</label>
                                <input type="text" class="form-control @error('ibu_kandung') is-invalid @enderror" id="ibu_kandung" value="{{ old('ibu_kandung') }}" name="ibu_kandung" placeholder="Masukkan nama ibu kandung" autofocus required>
                            </div>
                            @error('ibu_kandung')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="hub_kel" class="form-label">Hubungan Keluarga</label>
                                <input type="text" class="form-control @error('hub_kel') is-invalid @enderror" id="hub_kel" value="{{ old('hub_kel') }}" name="hub_kel" placeholder="Hubungan Keluarga" autofocus required>
                            </div>
                            @error('hub_kel')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="desa_kelurahan" class="form-label">Desa/Kelurahan</label>
                                <input type="text" class="form-control @error('desa_kelurahan') is-invalid @enderror" id="desa_kelurahan" value="{{ old('desa_kelurahan') }}" name="desa_kelurahan" placeholder="Nama Desa" autofocus required>
                            </div>
                            @error('desa_kelurahan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="dusun" class="form-label">Dusun</label>
                                <input type="text" class="form-control @error('dusun') is-invalid @enderror" id="dusun" value="{{ old('dusun') }}" name="dusun" placeholder="Nama Dusun" autofocus required>
                            </div>
                            @error('dusun')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <div class="mb-4">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" autofocus required> </textarea>
                                </div>
                                @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="reset" class="btn btn-secondary mr-2">Close</button>
                        <button type="submit" class="btn btn-primary" onclick="showLoadingModal()">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
    <script>
        function showLoadingModal() {
            // Show the loading modal
            $('#loadingModal').modal('show');

            // Prevent the automatic form submission
            event.preventDefault();

            // Submit the form after a short delay to allow the modal to appear
            setTimeout(function() {
                $('#pendudukForm').submit();
            }, 500);
        }
    </script>


    <script>
        (function() {
            preventDefault();
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);

        })
        ();
    </script>

@endsection