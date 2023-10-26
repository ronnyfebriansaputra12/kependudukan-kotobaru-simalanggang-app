@extends('layouts.pencarian.main')
@section('title', 'Detail Data Penduduk')
@section('container')

<div class="card card-body mx-auto w-100">
  <div class="text-center mb-3">
    <h3>Detail Data Penduduk</h3>
  </div>
  <div class="row">
    <div class="col-md-4">
      <div class="card card-warning card-outline">
        <div class="card-body box-profile">
          <div class="text-center">
            <img class="profile-user-img img-fluid img-circle" src="{{ asset('adminlte/dist/img/user4-128x128.jpg') }}" alt="User profile picture">
          </div>
          <h3 class="profile-username text-center">{{ $penduduk->nama }}</h3>
          <h3 class="profile-username text-center">{{ $penduduk->alamat }}</h3>
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <div class="card card-warning">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <!-- Left column -->
              <div class="form-group">
                <label for="uid">UID</label>
                <input type="text" name="uid" class="form-control" value="{{ $penduduk->uid }}" readonly>
              </div>
              <div class="form-group">
                <label for="nik">NIK</label>
                <input type="text" name="nik" class="form-control" value="{{ $penduduk->nik }}" readonly>
              </div>
              <div class="form-group">
                <label for="tmp_lahir">Tempat Lahir</label>
                <input type="text" name="tmp_lahir" class="form-control" value="{{ $penduduk->tmp_lahir }}" readonly>
              </div>
              <div class="form-group">
                <label for="jekel">Jenis Kelamin</label>
                <input type="text" name="jekel" class="form-control" value="{{ $penduduk->jekel }}" readonly>
              </div>
              <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" class="form-control" value="{{ $penduduk->alamat }}" readonly>
              </div>
              <div class="form-group">
                <label for="desa_kelurahan">Desa/Kelurahan</label>
                <input type="text" name="desa_kelurahan" class="form-control" value="{{ $penduduk->desa_kelurahan }}" readonly>
              </div>
            </div>
            <div class="col-md-6">
              <!-- Right column -->
              <div class="form-group">
                <label for="no_kk">No. KK</label>
                <input type="text" name="no_kk" class="form-control" value="{{ $penduduk->no_kk }}" readonly>
              </div>
              <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" class="form-control" value="{{ $penduduk->nama }}" readonly>
              </div>
              <div class="form-group">
                <label for="tgl_lahir">Tanggal Lahir</label>
                <input type="text" name="tgl_lahir" class="form-control" value="{{ $penduduk->tgl_lahir }}" readonly>
              </div>
              <div class="form-group">
                <label for="hub_kel">Hubungan Keluarga</label>
                <input type="text" name="hub_kel" class="form-control" value="{{ $penduduk->hub_kel }}" readonly>
              </div>
              <div class="form-group">
                <label for="pekerjaan">Pekerjaan</label>
                <input type="text" name="pekerjaan" class="form-control" value="{{ $penduduk->pekerjaan }}" readonly>
              </div>
              <div class="form-group">
                <label for="dusun">Dusun</label>
                <input type="text" name="dusun" class="form-control" value="{{ $penduduk->dusun }}" readonly>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="mx-auto text-center">
    <a href="{{url('/')}}" class="btn btn-danger">Kembali</a>
  </div>
</div>

@endsection