@extends('layouts.pencarian.main')
@section('title', 'Cari Data Penduduk')
@section('container')

    <style>
        @media screen and (max-width: 780px) {
            img.img-background {
                width: 100%;
                margin-bottom: 25px;
            }

            h5.login-box-msg {
                font-style: italic;
                margin-top: -10px;
            }

            a.text-search {
                font-size: 25px;
                color: black;

            }
        }
    </style>

    <div class="card card-outline card-success w-75 mx-auto">
        <div class="text-center mt-2">
            <img src="{{ asset('AdminLTE') }}/dist/img/50kota.png" class="img-background" style="width: 100px" alt="">
        </div>
        <div class="text-center">
            <a href="{{ url('/') }}" class="text-search h1"><b>Cari Data Penduduk</b></a>
        </div>
        <div class="card-body mx-auto ">
            <h5 class="login-box-msg ">Silakan Scan KTP Anda</h5>
            <form action="/" method="GET">
                <div class="input-group mb-3">
                    <input type="text" name="search" class="form-control" value="{{ old('uid') }}" placeholder="UID"
                        autofocus onchange="this.form.submit()">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @if ($penduduks)
        <div class="card card-body card-outline card-success mx-auto w-100">
            <div class="table-container">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>UID</th>
                            <th>NIK</th>
                            <th>No KK</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penduduks as $value)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $value->uid ? ucwords($value->uid) : '-' }}</td>
                                <td>{{ ucwords($value->nik) }}</td>
                                <td>{{ ucwords($value->no_kk) }}</td>
                                <td>{{ ucwords($value->nama) }}</td>
                                <td>{{ ucwords($value->jekel) }}</td>
                                <td>{{ ucwords($value->alamat) }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ url('/detail-penduduk/' . $value->nik) }}"
                                            class="btn btn-info btn-sm btn-detail me-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                <path
                                                    d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('login', ['nik' => $value->nik]) }}"
                                            class="btn btn-success mx-2">
                                            <i class="fas fa-sign-in-alt"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection
