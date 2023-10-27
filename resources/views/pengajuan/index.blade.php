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
                                    <th>Nama</th>
                                    <th>Jenis Surat</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengajuan as $value)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $value->penduduk->nik }}</td>
                                        <td>{{ $value->penduduk->nama }}</td>
                                        <td>{{ $value->jenissurat->name_surat }}</td>
                                        <td style="text-align: center">
                                            <span
                                                style="background-color: {{ $value->status === '0' ? '#8B0000' : '#1E7E34' }}; border-radius: 12px; padding: 6px; font-size: 15px; color: white; display: inline-block;">
                                                @if ($value->status === '0')
                                                    Belum Disetujui
                                                @elseif ($value->status === '1')
                                                    Disetujui
                                                @endif
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                @if ($value->status === '0')
                                                    @if (session()->has('admin'))
                                                        <button type="button" class="btn btn-warning btn-sm me-1"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#btn-edit{{ $value->id }}">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                    @elseif(session()->has('penduduk'))
                                                        <a href="{{ url('/pengajuan/' . $value->id . '/edit') }}"
                                                            class="btn btn-warning btn-sm me-1">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    @endif
                                                @endif
                                                <a href="#" id="btn-hapus" class="btn btn-danger btn-sm"
                                                    data-id="{{ $value->id }}" title="Hapus">
                                                    <i class="fa-solid fas fa-trash"></i>
                                                </a>
                                                <!-- Tampilkan tombol Print jika status disetujui -->
                                                @if ($value->status === '1')
                                                    <a href="{{ url('/cetak-surat/' . $value->id_jenis_surat) }}"
                                                        class="btn btn-success btn-sm me-1">
                                                        <i class="fa fa-print"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                            <script>
                                function printSurat(id) {
                                    // Logika untuk mengarahkan ke halaman cetak surat berdasarkan ID
                                    window.location.href = '{{ url('/cetak-surat') }}/' + id;
                                }
                            </script>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="btn-edit{{ $value->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Form Ubah Status Pengajuan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/pengajuan/' . $value->id) }}" method="post">
                        @csrf
                        @method('PUT') <!-- Add this line for a PUT request -->

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" id="status">
                                <option value="0" {{ $value->status === '0' ? 'selected' : '' }}>Belum
                                    Disetujui</option>
                                <option value="1" {{ $value->status === '1' ? 'selected' : '' }}>
                                    Disetujui</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">No Dokumen</label>
                            <input type="text" name="no_dokumen_perjalanan" class="form-control"
                                id="no_dokumen_perjalanan" value="{{ $value->no_dokumen_perjalanan }}"
                                placeholder="Enter No Dokumen">
                        </div>

                        <!-- Your existing submit button -->
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection
