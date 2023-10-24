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


                {{-- <div class="col-md-8">
                    <!-- About Me Box -->
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Profile</h3>

                            <button type="button" class="btn btn-primary btn-sm float-right mr-3" data-bs-toggle="modal"
                                data-bs-target="#modalChangePassword{{ $profile->nik }}">
                                <i class="fas fa-key"></i> Change Password
                            </button>


                        </div>
                       

                    </div>
                    <!-- /.card -->
                </div> --}}
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
                            <form>
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- Left column -->
                                        <div class="form-group">
                                            <label for="uid">UID</label>
                                            <input type="text" name="uid" class="form-control"
                                                value="{{ $profile->uid }}" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="nik">NIK</label>
                                            <input type="text" name="nik" class="form-control"
                                                value="{{ $profile->nik }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="tmp_lahir">Tempat Lahir</label>
                                            <input type="text" name="tmp_lahir" class="form-control"
                                                value="{{ $profile->tmp_lahir }}" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="jekel">Jenis Kelamin</label>
                                            <input type="text" name="jekel" class="form-control"
                                                value="{{ $profile->jekel }}" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <input type="text" name="alamat" class="form-control"
                                                value="{{ $profile->alamat }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="desa_kelurahan">Desa/Kelurahan</label>
                                            <input type="text" name="desa_kelurahan" class="form-control"
                                                value="{{ $profile->desa_kelurahan }}" readonly>
                                        </div>

                                    </div>


                                    <div class="col-md-6">
                                        <!-- Right column -->
                                        <div class="form-group">
                                            <label for="no_kk">No. KK</label>
                                            <input type="text" name="no_kk" class="form-control"
                                                value="{{ $profile->no_kk }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" name="nama" class="form-control"
                                                value="{{ $profile->nama }}" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="tgl_lahir">Tanggal Lahir</label>
                                            <input type="text" name="tgl_lahir" class="form-control"
                                                value="{{ $profile->tgl_lahir }}" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="hub_kel">Hubungan Keluarga</label>
                                            <input type="text" name="hub_kel" class="form-control"
                                                value="{{ $profile->hub_kel }}" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="pekerjaan">Pekerjaan</label>
                                            <input type="text" name="pekerjaan" class="form-control"
                                                value="{{ $profile->pekerjaan }}" readonly>
                                        </div>
                                        <div class="form-group">
                                        <label for="dusun">Dusun</label>
                                        <input type="text" name="dusun" class="form-control"
                                            value="{{ $profile->dusun }}" readonly>
                                    </div>

                                    <!-- Add other fields here -->
                                </div>
                                
                        </div>

                        < <!-- Add other fields here -->
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


    <div class="modal fade" id="modalChangePassword{{ $profile->nik }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
