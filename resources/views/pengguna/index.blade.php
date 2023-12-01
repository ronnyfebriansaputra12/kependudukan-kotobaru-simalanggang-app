@extends('layouts.master')
@section('title', 'Pengguna')
@section('header', 'Data Pengguna')
@section('breadcrumb', 'Pengguna')

@section('container-fluid')

<div class="container">
  <a href="{{url('/pengguna/create')}}" class="btn btn-outline-success"><i class="fa-solid fas fa-plus"></i> Tambah Data Pengguna</a>
  <div class="card card-outline card-success mt-3">
    <div class="card-body">
      <div id="example_wrapper">
        <div class="table-responsive table-bordered">
          <table id="example1" class="table  table-striped ">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Verifikasi Email</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($penggunas as $value)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ ucwords($value->name) }}</td>
                <td>{{ ucwords($value->email) }}</td>
                <td>
                  @if ($value->email_verified_at)
                  {{ \Carbon\Carbon::parse($value->email_verified_at)->format('d-m-Y H:i:s') }}
                  @else
                  Belum diverifikasi
                  @endif
                </td>
                <td>
                  <div class="d-flex">
                    @if ($value->uid !== null)
                    <a href="{{ url('capture/' . $value->nik) }}" id="btn-camera" class="btn btn-success btn-sm me-1" data-id="{{ $value->nik }}"><i class="fa-solid fas fa-camera"></i>
                    </a>
                    @endif
                    <a href="{{ url('/pengguna/' . $value->nik) }}" class="btn btn-info btn-sm btn-detail me-1">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                      </svg>
                      </q>
                      <a href="{{ url('/penduduk/' . $value->nik . '/edit') }}" class="btn btn-warning btn-sm me-1">
                        <i class="fa fa-edit"></i>
                      </a>
                      <a href="#" id="btn-hapus" class="btn btn-danger btn-sm" data-id="{{ $value->nik }}"><i class="fa-solid fas fa-trash"></i>
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
  
  <div class="card-footer clearfix">
    {{ $penggunas->links('pagination::bootstrap-5') }}
  </div>
</div>
@endsection