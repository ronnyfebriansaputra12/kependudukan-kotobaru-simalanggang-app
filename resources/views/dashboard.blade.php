@extends('layouts.master')

@section('title', 'Penduduk')
@section('header', 'Dahsboard')
@section('breadcrumb', 'dashboard')

@section('container-fluid')
    <!-- Main content -->
    @if (session()->has('admin'))
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $suratTidakMampu }}</h3>
                                <p>Surat Keterangan Tidak Mampu</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-file-alt"></i>
                            </div>
                            <a href="/pengajuan" class="small-box-footer"> Lihat Pengajuan<i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-sm-12 col-md-4">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $suratDomisili }}</h3>
                                <p>Surat Keterangan Domisili</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-file-alt"></i>
                            </div>
                            <a href="/pengajuan" class="small-box-footer">Lihat Pengajuan <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-sm-12 col-md-4">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $suratKematian }}</h3>
                                <p>Surat Kematian</p>
                            </div>

                            <div class="icon">
                                <i class="fa fa-file-alt"></i>
                            </div>
                            <a href="/pengajuan" class="small-box-footer">Lihat Pengajuan <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="card ">
                    <div class="card-header">
                        <div class="text-center fw-bold">Tabel Pengajuan Penduduk </div>
                    </div>
                    <div class="card-body">
                        <div id="example_wrapper">

                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>NIK</th>
                                        <th>Jenis Pengajuan</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengajuans as $value)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $value->nik_penduduk }}</td>
                                            <td>{{ $value->jenisSurat->name_surat }}</td>
                                            <td>{{ Carbon\Carbon::parse($value->created_at)->isoFormat('DD MMMM Y') }}
                                            </td>
                                            <td>
                                                <div class="badge bg-success">Disetujui</div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="card ">
                            <div class="card-header">
                                <div class="text-center fw-bold">Grafik Penduduk Berdasarkan Jenis Kelamin</div>
                            </div>
                            <div class="card-body">
                                {!! $chart->container() !!}
                                {!! $chart->script() !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="card ">
                            <div class="card-header">
                                <div class="text-center fw-bold">Grafik Penduduk Berdasarkan Domisili</div>
                            </div>
                            <div class="card-body">
                                {!! $domisili->container() !!}
                                {!! $domisili->script() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if (session()->has('penduduk'))
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>Surat Keterangan</h3>
                                <p>Tidak Mampu</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-file-alt"></i>
                            </div>
                            <a href="/pengajuan" class="small-box-footer">Ajukan Surat <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>Surat Keterangan</h3>
                                <p>Domisili</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-file-alt"></i>
                            </div>
                            <a href="/pengajuan" class="small-box-footer">Ajukan Surat <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3 style="overflow-wrap: break-word;">Surat Kematian</h3>
                                <p>Surat Kematian</p>
                            </div>

                            <div class="icon">
                                <i class="fa fa-file-alt"></i>
                            </div>
                            <a href="/pengajuan" class="small-box-footer">Ajukan Surat <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                </div>

            </div>
        </section>
    @endif
    <!-- /.content -->
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
    </script>

@endsection
