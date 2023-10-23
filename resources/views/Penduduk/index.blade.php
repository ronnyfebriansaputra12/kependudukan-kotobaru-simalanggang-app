@extends('layouts.master')

@section('title', 'Penduduk')
@section('header', 'Data Penduduk')
@section('breadcrumb', 'Penduduk')

@section('container-fluid')

    <div class="container">
        {{-- <button type="button" class="btn btn-primary">
            <i class="fa-solid fas fa-plus"></i> Tambah Data Penduduk
        </button> --}}

        <a href="/penduduk/create" class="btn btn-primary"><i class="fa-solid fas fa-plus"></i> Tambah Data Penduduk</a>

        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">Data Penduduk Nagari Koto Baru Simalanggang</h3>

                <button type="button" class="btn btn-success float-right" data-bs-toggle="modal"
                    data-bs-target="#exampleModalExcle">
                    <i class="fa-solid fas fa-file"></i> Import Excel
                </button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div id="example_wrapper">
                    <form method="POST" action="/auto-save">
                        @csrf
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
                                                    <button type="button" id="{{ $value->nik }}"
                                                        class="btn btn-info btn-sm btn-detail me-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-info-circle"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                            <path
                                                                d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                                        </svg> Detail
                                                    </button>
                                                    <button type="button" class="btn btn-warning btn-sm me-1"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#btn-edit{{ $value->nik }}">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </button>
                                                    <a href="#" id="btn-hapus" class="btn btn-danger btn-sm"
                                                        data-id="{{ $value->nik }}"><i class="fa-solid fas fa-trash"></i>
                                                        Delete</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                {{-- <tfoot>
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>No KK</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Tanggal Lahir</th>
                                <th>Tempat Lahir</th>
                                <th>Alamat</th>
                                <th>Action</th>
                            </tr>
                        </tfoot> --}}
                            </table>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>

    <!-- Modal Import Data -->
    <div class="modal fade" id="exampleModalExcle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel">Pemasukan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="/penduduk-excel" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="file" class="form-label">File Excle</label>
                            <input type="file" class="form-control @error('file') is-invalid @enderror" id="file"
                                name="file" placeholder="File Excle" autofocus>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });

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

    {{-- <script>
        $(document).ready(function() {
            // Menggunakan event input untuk mendeteksi perubahan pada input field
            $('.uid-input').on('input', function() {
                var inputValue = $(this).val();
                var iteration = $(this).closest('tr').find('td:first').text();

                // Mengirim data ke server menggunakan AJAX
                $.ajax({
                    url: '/auto-save',
                    type: 'POST',
                    data: {
                        iteration: iteration,
                        uid: inputValue
                    },
                    success: function(response) {
                        console.log('Data disimpan:', response);
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });
        });
    </script> --}}

@endsection
