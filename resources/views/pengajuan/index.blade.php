@extends('layouts.master')

@section('title', 'Penduduk')
@section('header', 'Data Penduduk')
@section('breadcrumb', 'Penduduk')

@section('container-fluid')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Table List Data Pengajuan</h3>

                        @if (session()->has('penduduk'))
                            <a href="{{ route('pengajuan-create', ['nik' => session('penduduk.nik')]) }}"
                                class="btn btn-primary float-right">
                                <i class="fa-solid fas fa-plus"></i> Tambah Pengajuan
                            </a>
                        @elseif (session()->has('admin'))
                            <a href="/penduduk/create" style="display: none;" class="btn btn-primary float-right"><i
                                    class="fa-solid fas fa-plus"></i> Tambah
                                Pengajuan</a>
                        @endif

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NIK</th>
                                    <th>Name</th>
                                    <th>Jenis Surat</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
