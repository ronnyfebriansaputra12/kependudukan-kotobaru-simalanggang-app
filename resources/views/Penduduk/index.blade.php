@extends('layouts.master')
@section('title', 'Penduduk')
@section('header', 'Data Penduduk')
@section('breadcrumb', 'Penduduk')

@section('container-fluid')

    <!-- Loading Modal -->
    <div class="modal fade" id="loadingModal" tabindex="-1" aria-labelledby="loadingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-dialog-centered ">
            <div class="modal-content ">
                <div class="modal-body text-center">
                    <img src="{{ asset('AdminLTE') }}/dist/img/loading.gif" width="200px" height="150px" style="background: rgba(255, 255, 255, 0);" />
                    <p class="mt-2">Import Data Penduduk, Mohon Tunggu Sebentar...</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container">

        <a href="/penduduk/create" class="btn btn-outline-success"><i class="fa-solid fas fa-plus"></i> Tambah Data
            Penduduk</a>

        <div class="card card-outline card-success mt-3">
            <div class="card-header">
                <form action="/penduduk" method="GET">
                    <input type="text" name="search" id="liveSearch" class="form-control w-25 float-left"
                        placeholder="Search..." onchange="this.form.submit()">
                </form>
                <a href="/penduduk" class=" ml-2 btn btn-secondary" title="reset"> <i class="fas fa-sync-alt"
                        title="reset"></i></a>
                <button type="button" class="btn btn-outline-success float-right col-sm-" data-bs-toggle="modal"
                    data-bs-target="#exampleModalExcle">
                    <span class="d-none d-sm-inline">
                        <i class="fa-solid fas fa-file"></i> Import Excel
                    </span>
                    <span class="d-sm-none" title="import excel">
                        <i class="fa-solid fas fa-file" title="Import Excel"></i>
                    </span>
                </button>
            </div>

            <div class="card-body">
                <div id="example_wrapper">
                    <div class="table-responsive table-bordered">
                        <table id="example1" class="table  table-striped ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>UID</th>
                                    <th>NIK</th>
                                    <th>No KK</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Dusun</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penduduks as $value)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if ($value->uid === null)
                                                <form action="{{ url('/uid-penduduk/' . $value->nik) }}" method="post">
                                                    @method('PATCH')
                                                    @csrf
                                                    <input type="text"
                                                        class="form-control @error('uid') is-invalid @enderror"
                                                        name="uid" value="{{ $value->uid }}"
                                                        onchange="this.form.submit()">
                                                    @error('uid')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </form>
                                            @else()
                                                {{ $value->uid }}
                                            @endif
                                        </td>
                                        <td>{{ ucwords($value->nik) }}</td>
                                        <td>{{ ucwords($value->no_kk) }}</td>
                                        <td>{{ ucwords(strtolower($value->nama)) }}</td>
                                        <td>{{ ucwords(strtolower($value->jekel)) }}</td>
                                        <td>{{ ucwords(strtolower($value->dusun)) }}</td>
                                        <td>
                                            <div class="d-flex">
                                                @if ($value->uid !== null)
                                                    <a href="{{ url('capture/' . $value->nik) }}" id="btn-camera"
                                                        class="btn btn-success btn-sm me-1"
                                                        data-id="{{ $value->nik }}"><i
                                                            class="fa-solid fas fa-camera"></i>
                                                    </a>
                                                @endif
                                                <a href="{{ url('/penduduk/' . $value->nik) }}"
                                                    class="btn btn-info btn-sm btn-detail me-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                                        <path
                                                            d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                        <path
                                                            d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                                    </svg>
                                                    </q>
                                                    <a href="{{ url('/penduduk/' . $value->nik . '/edit') }}"
                                                        class="btn btn-warning btn-sm me-1">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="#" id="btn-hapus" class="btn btn-danger btn-sm"
                                                        data-id="{{ $value->nik }}"><i class="fa-solid fas fa-trash"></i>
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

            <div class="card-footer clearfix">
                {{ $penduduks->links('pagination::bootstrap-5') }}
            </div>
        </div>

        <!-- Modal Import Data -->
        <div class="modal fade" id="exampleModalExcle" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="exampleModalLabel">Penduduk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/penduduk-excel" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="file" class="form-label">File Excel</label>
                                <input type="file" class="form-control @error('file') is-invalid @enderror"
                                    id="file" name="file" placeholder="File Excel" autofocus>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- JavaScript section -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    {{-- Data Table --}}
    <script>
        // --------------DELETE USER----------------
        $(document).on('click', '#btn-hapus', function(e) {
            e.preventDefault();
            var link = $(this).attr('data-id');
            console.log(link);

            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Data Akan di Hapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "/penduduk" + "/delete/" + link;
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        })
    </script>
    <!-- Tambahkan script ini sebelum </body> tag -->
    <script>
        // Fungsi untuk menangani data RFID
        function handleRFID(uid) {
            // Mengosongkan kolom UID
            $("#uid-column").text("");

            // Jika UID tidak kosong, set nilai kolom UID
            if (uid) {
                $("#uid-column").text(uid);
            }
        }

        // Fungsi untuk mendeteksi pembacaan RFID (Contoh: event 'rfidDetected' di-trigger ketika RFID terdeteksi)
        $(document).on('rfidDetected', function(event, uid) {
            handleRFID(uid);
        });

        // Dummy function untuk mensimulasikan deteksi RFID
        function simulateRFIDDetection() {
            // Simulasikan UID dari pembacaan RFID
            var simulatedUID = "123456789";

            // Trigger event untuk menangani RFID
            $(document).trigger('rfidDetected', [simulatedUID]);
        }

        // Panggil fungsi untuk mensimulasikan deteksi RFID
        simulateRFIDDetection();
    </script>
    <script>
        // Show the loading spinner
        function showLoadingSpinner() {
            $('#loadingSpinner').show();
        }

        // Hide the loading spinner
        function hideLoadingSpinner() {
            $('#loadingSpinner').hide();
        }

        // Trigger the loading spinner when the page is being loaded
        $(document).ready(function() {
            showLoadingSpinner();
        });

        // Trigger the loading spinner when the form is being submitted
        $('form').submit(function() {
            showLoadingSpinner();
        });
    </script>
    <script>
        // Existing JavaScript code

        // Show the loading modal
        function showLoadingModal() {
            $('#loadingModal').modal('show');
        }

        // Hide the loading modal
        function hideLoadingModal() {
            $('#loadingModal').modal('hide');
        }

        // Trigger the loading modal when the form is being submitted
        $('#exampleModalExcle form').submit(function() {
            showLoadingModal();
        });
    </script>


@endsection
