@extends('layouts.master')

@section('title', 'Penduduk')
@section('header', 'Jenis Jenis Surat')
@section('breadcrumb', 'Penduduk')

@section('container-fluid')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Table List Data Jenis Surat</h3>
                    <a href="#">
                        <button type="button" class="btn btn-primary btn-sm float-right mr-3" data-bs-toggle="modal"
                            data-bs-target="#modalTambah">
                            <i class="fas fa-plus"></i> Tambah Jenis Surat
                        </button>
                    </a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Name Surat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jenissurat as $value)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ ($value->name_surat) }}</td>
                                    <td>
                                        <div class="d-flex">
                                            
                                            <button type="button" class="btn btn-warning btn-sm me-1"
                                                data-bs-toggle="modal" data-bs-target="#btn-edit{{ $value->id }}">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <a href="#" id="btn-hapus" class="btn btn-danger btn-sm"
                                                data-id="{{ $value->id }}"><i class="fa-solid fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Form Tambah Jenis Surat</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/jenis-surat') }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" class="form-control @error('name_surat') is-invalid @enderror"
                                name="name_surat" value="{{ old('name_surat') }}" placeholder="Nama Surat">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-file"></span>
                                </div>
                            </div>
                            @error('name_surat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Tambah</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
