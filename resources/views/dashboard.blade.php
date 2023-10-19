@extends('layouts.master')

@section('title', 'Dashboard')
@section('header', 'Dashboard')
@section('breadcrumb', 'Dashboard')

@section('container-fluid')
    {{-- <div class="container">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title">Formulir Penduduk</h5>
            </div>
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label for="uid">UID</label>
                        <input type="text" class="form-control" id="uid" value="{{ $penduduk->uid }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" class="form-control" id="nik" value="{{ $penduduk->nik }}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="no_kk">Nomor KK</label>
                        <input type="text" class="form-control" id="no_kk" value="{{ $penduduk->nik }}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" value="penduduk1" readonly>
                    </div>
                    <div class="form-group">
                        <label for="tmp_lahir">Tempat Lahir</label>
                        <input type="text" class="form-control" id="tmp_lahir" value="padang" readonly>
                    </div>
                    <div class="form-group">
                        <label for="tgl_lahir">Tanggal Lahir</label>
                        <input type="text" class="form-control" id="tgl_lahir" value="2002-08-03" readonly>
                    </div>
                    <div class="form-group">
                        <label for="jekel">Jenis Kelamin</label>
                        <input type="text" class="form-control" id="jekel" value="Laki-laki" readonly>
                    </div>
                    <div class="form-group">
                        <label for="ibu_kandung">Ibu Kandung</label>
                        <input type="text" class="form-control" id="ibu_kandung" value="ibu1" readonly>
                    </div>
                    <div class="form-group">
                        <label for="hub_kel">Hubungan Keluarga</label>
                        <input type="text" class="form-control" id="hub_kel" value="anak" readonly>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" value="padang" readonly>
                    </div>
                    <div class="form-group">
                        <label for="pekerjaan">Pekerjaan</label>
                        <input type="text" class="form-control" id="pekerjaan" value="mahasiswa" readonly>
                    </div>
                    <div class="form-group">
                        <label for="kelurahan">Kelurahan</label>
                        <input type="text" class="form-control" id="kelurahan" value="koto tangah" readonly>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div> --}}
@endsection
