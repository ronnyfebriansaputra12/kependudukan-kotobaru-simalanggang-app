@extends('layouts.master')

@section('title', 'Jenis Surat')
@section('header', 'Jenis Jenis Surat')
@section('breadcrumb', 'Jenis Surat')

@section('container-fluid')
    <div class="row">
        <div class="col-12 mb-3 ">
            <button type="button" class="btn btn-outline-success " data-bs-toggle="modal"
                data-bs-target="#modalTambah">
                <i class="fas fa-plus"></i> Tambah Jenis Surat
            </button>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div id="example_wrapper">
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
                                        <td>{{ $value->name_surat }}</td>
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

                                    <!-- Modal Edit Jenis Surat -->
                                    <div class="modal fade" id="btn-edit{{ $value->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Jenis Surat
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ url('/jenis-surat/' . $value->id) }}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <!-- Add this line to specify the method as PATCH for updating -->

                                                        <div class="form-group">
                                                            <label for="status">Nama Surat</label>
                                                            <input type="text" name="name_surat" class="form-control"
                                                                id="name_surat" value="{{ $value->name_surat }}"
                                                                placeholder="Enter No Dokumen">
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-12">
                                                                <button type="submit"
                                                                    class="btn btn-primary btn-block">Update</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,

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
                    window.location = "/jenis-surat" + "/delete/" + link;
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        })
    </script>

    {{-- <script>
        $(document).on('click', '.btn-warning', function() {
            var id = $(this).data('id');
            var name = $(this).data('name');

            $('#edit_jenis_surat_id').val(id);
            $('#edit_name_surat').val(name);
        });
    </script> --}}

@endsection
