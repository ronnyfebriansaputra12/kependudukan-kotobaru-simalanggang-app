@extends('layouts.master')

@section('title', 'Verifikasi Penduduk')
@section('header', 'Verifikasi Penduduk')
@section('breadcrumb', 'Verifikasi Penduduk')

@section('container-fluid')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Penduduk
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($capture as $item)
                        <div class="col-md-3">
                            <p>{{ $item->penduduk->nama }} - {{ $item->nik_penduduk }}</p>
                            <img src="{{ $item->file_gambar }}" alt="Gambar" width="200px">
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
@endsection
