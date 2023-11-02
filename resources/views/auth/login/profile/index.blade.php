@extends('layouts.master')

@section('title', 'Profile')
@section('breadcrumb', 'Profile')

@section('container-fluid')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <!-- Profile Image -->
                    <div class="card card-warning card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{ asset('adminlte/dist/img/user4-128x128.jpg') }}" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ $profile->nama }}</h3>
                            <h3 class="profile-username text-center">{{ $profile->alamat }}</h3>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->

                <div class="col-md-8">
                    <!-- About Me Box -->
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Profile</h3>

                            <button type="button" class="btn btn-primary btn-sm float-right mr-3" data-bs-toggle="modal"
                                data-bs-target="#modalChangePassword{{ $profile->nik }}">
                                <i class="fas fa-key"></i> Change Password
                            </button>
                        </div>

                        <div class="card-body">
                            <form action="{{ url('profilePenduduk/update/' . $profile->nik) }}" method="post">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- Left column -->
                                        <div class="form-group">
                                            <label for="uid">UID</label>
                                            <input type="text" name="uid" class="form-control"
                                                value="{{ $profile->uid }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="tmp_lahir">Tempat Lahir</label>
                                            <input type="text" name="tmp_lahir" class="form-control"
                                                value="{{ $profile->tmp_lahir }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="jekel">Jenis Kelamin</label>
                                            <select name="jekel" class="form-control">
                                                <option value="Laki-laki" @if ($profile->jekel == 'Laki-laki') selected @endif>
                                                    Laki-laki</option>
                                                <option value="Perempuan" @if ($profile->jekel == 'Perempuan') selected @endif>
                                                    Perempun</option>
                                            </select>

                                        </div>
                                        @php
                                            // dd($profile);
                                        @endphp
                                        <div class="form-group">
                                            <label for="agama">Agama</label>
                                            <select name="agama" class="form-control">
                                                {{-- <option value="" disabled selected>--Pilih Agama--</option> --}}

                                                <option value="Islam" @if ($profile->agama == 'Islam') selected @endif>
                                                    Islam</option>
                                                <option value="Kristen" @if ($profile->agama == 'Kristen') selected @endif>
                                                    Kristen</option>
                                                <option value="Katolik" @if ($profile->agama == 'Katolik') selected @endif>
                                                    Katolik</option>
                                                <option value="Hindu" @if ($profile->agama == 'Hindu') selected @endif>
                                                    Hindu</option>
                                                <option value="Buddha" @if ($profile->agama == 'Buddha') selected @endif>
                                                    Buddha</option>
                                                <option value="Konghucu" @if ($profile->agama == 'Konghucu') selected @endif>
                                                    Konghucu</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Nama Ibu Kandung</label>
                                            <input type="text" name="ibu_kandung" class="form-control"
                                                value="{{ $profile->ibu_kandung }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="status_perkawinan">Status Perkawinan</label>
                                            <select name="status_perkawinan" class="form-control">
                                                <option value="Belum Kawin"
                                                    @if ($profile->status_perkawinan == 'Belum Kawin') selected @endif>
                                                    Belum Kawin</option>
                                                <option value="Kawin" @if ($profile->status_perkawinan == 'Kawin') selected @endif>
                                                    Kawin</option>
                                                <option value="Cerai Hidup"
                                                    @if ($profile->status_perkawinan == 'Cerai Hidup') selected @endif>
                                                    Cerai Hidup</option>
                                                <option value="Cerai Mati" @if ($profile->status_perkawinan == 'Cerai Mati') selected @endif>
                                                    Cerai Mati</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="desa_kelurahan">Desa/Kelurahan</label>
                                            <input type="text" name="desa_kelurahan" class="form-control"
                                                value="{{ $profile->desa_kelurahan }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Right column -->
                                        <div class="form-group">
                                            <label for="nik">NIK</label>
                                            <input type="text" name="nik" class="form-control"
                                                value="{{ $profile->nik }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="no_kk">No. KK</label>
                                            <input type="text" name="no_kk" class="form-control"
                                                value="{{ $profile->no_kk }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="nama">Nama Lengkap</label>
                                            <input type="text" name="nama" class="form-control"
                                                value="{{ $profile->nama }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="tgl_lahir">Tanggal Lahir</label>
                                            <input type="date" name="tgl_lahir" class="form-control"
                                                value="{{ $profile->tgl_lahir }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="hub_kel">Hubungan Keluarga</label>
                                            <input type="text" name="hub_kel" class="form-control"
                                                value="{{ $profile->hub_kel }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="pekerjaan">Pekerjaan</label>
                                            <input type="text" name="pekerjaan" class="form-control"
                                                value="{{ $profile->pekerjaan }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="dusun">Dusun</label>
                                            <input type="text" name="dusun" class="form-control"
                                                value="{{ $profile->dusun }}">
                                        </div>
                                        <!-- Add other fields here -->
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" name="alamat" class="form-control"
                                            value="{{ $profile->alamat }}">
                                    </div>
                                    <div class="col-2 mx-auto">
                                        <button class="btn btn-success rounded-0" type="submit">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <div class="modal fade" id="modalChangePassword{{ $profile->nik }}" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Change Passowrd</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/changePassword') }}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $profile->id }}">
                        <div class="input-group mb-3">
                            <input type="password" class="form-control @error('password_lama') is-invalid @enderror"
                                name="password_lama" value="{{ old('password_lama') }}" placeholder="New Password Lama">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-key"></span>
                                </div>
                            </div>
                            @error('password_lama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" value="{{ old('password') }}" placeholder="New Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-key"></span>
                                </div>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                        <div class="input-group mb-3">
                            <input type="password"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                name="password_confirmation" value="{{ old('password_confirmation') }}"
                                placeholder="New Password Confirmation">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-key"></span>
                                </div>
                            </div>
                            @error('passowrd_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="row">
                            <!-- /.col -->
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Save</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
