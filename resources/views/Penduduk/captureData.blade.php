@extends('layouts.master')

@section('title', 'Verifikasi Penduduk')
@section('header', 'Verifikasi Penduduk')
@section('link')
    <a href="{{ url('penduduk') }}">Penduduk</a>
@endsection
@section('breadcrumb', 'Verifikasi Penduduk')

@section('container-fluid')
    <div class="container">
        <div class="row">
            @foreach ($captures as $item)
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="col-md-12">
                                <p class="fw-bold">{{ ucwords(strtolower(substr($item->penduduk->nama, 0, 15))) }} -
                                    {{ $item->nik_penduduk }}</p>
                                <img src="{{ $item->file_gambar }}" alt="Gambar" width="200px">
                            </div>
                            <div>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="card-footer clearfix">
            {{ $captures->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
