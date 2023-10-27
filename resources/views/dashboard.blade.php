@extends('layouts.master')

@section('title', 'Penduduk')
@section('header', 'Dahboard')
@section('breadcrumb', 'dashboard')

@section('container-fluid')



    <!-- Main content -->
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
                        <a href="#" class="small-box-footer">Ajukan Surat <i
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
                        <a href="#" class="small-box-footer">Ajukan Surat <i
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
                        <a href="#" class="small-box-footer">Ajukan Surat <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

            </div>

        </div>
    </section>
    @endif
    @if (session()->has('admin'))
    <section class="content" hidden>
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
                        <a href="#" class="small-box-footer">Ajukan Surat <i
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
                        <a href="#" class="small-box-footer">Ajukan Surat <i
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
                        <a href="#" class="small-box-footer">Ajukan Surat <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

            </div>

        </div>
    </section>
    @endif
    
    <!-- /.content -->

@endsection
