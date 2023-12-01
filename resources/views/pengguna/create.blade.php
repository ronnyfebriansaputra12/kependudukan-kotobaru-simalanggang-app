@extends('layouts.master')
@section('title', 'Tambah Pengguna')
@section('header', ' Form Tambah Data Pengguna')
@section('link')
<a href="{{ url('pengguna') }}">Pengguna</a>
@endsection
@section('breadcrumb', 'Tambah Pengguna')

@section('container-fluid')
<!-- Loading Modal -->
<div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="loadingModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
        <div class="spinner-border text-success" role="status">
          <span class="sr-only">Loading...</span>
        </div>
        <p class="mt-2">Menambahkan Data Pengguna...</p>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <div class="card">
    <div class="card-body">
      <form action="{{url('pengguna')}}" method="POST">
        @csrf
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-2">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" name="name" placeholder="Masukkan nama lengkap" autofocus required>
                @error('name')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-2">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" name="email" placeholder="Masukkan email pengguna" autofocus required>
                @error('email')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-2">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" value="qwerty123" name="password" readonly>
                @error('password')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-4">
                <label for="password_confirmation" class="form-label">Password Confirmation</label>
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" value="qwerty123" name="password_confirmation" autofocus required readonly>
                @error('password_confirmation')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <input type="hidden" name="role" value="admin">
          </div>
        </div>
        <div class="d-flex justify-content-end">
          <button type="reset" class="btn btn-secondary mr-2">Close</button>
          <button type="submit" class="btn btn-primary" onclick="showLoadingModal()">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection