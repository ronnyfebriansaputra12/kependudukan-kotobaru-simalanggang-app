@extends('layouts.master')

@section('title', 'Penduduk')
@section('header', 'Form Pengajuan')
@section('breadcrumb', 'Penduduk')

@section('container-fluid')
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <div class="card card-primary">
                    <form action="{{ route('pengajuan') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="id_jenis_surat">Pilih Jenis Surat</label>
                                        <select name="id_jenis_surat" class="form-control" id="id_jenis_surat">
                                            <option>--Pilih Jenis Surat--</option>
                                            @foreach ($jenisSurats as $js)
                                                <option value="{{ $js->id }}">{{ $js->name_surat }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="nama">Nama Lengkap</label>
                                        <input type="text" nama="nama" disabled required value="{{ $penduduk->nama }}"
                                            class="form-control" id="nama" placeholder="Enter Name Anda">
                                    </div>
                                    <div class="form-group">
                                        <label for="tmp_lahir">Tempat Lahir</label>
                                        <input type="text" disabled name="tmp_lahir" required
                                            value="{{ $penduduk->tmp_lahir }}" class="form-control" id="tmp_lahir"
                                            placeholder="Enter Tempat Lahir">
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_lahir">Tanggal Lahir</label>
                                        <input type="date" disabled required name="tgl_lahir"
                                            value="{{ $penduduk->tgl_lahir }}" class="form-control" id="tgl_lahir"
                                            placeholder="Enter Tanggal lahir Anda">
                                    </div>
                                    <div class="form-group">
                                        <label for="jekel">Jenis Kelamin</label>
                                        <input type="text" disabled required name="jekel"
                                            value="{{ $penduduk->jekel }}" class="form-control" id="jekel"
                                            placeholder="Enter Tanggal lahir Anda">
                                    </div>
                                    <div class="form-group">
                                        <label for="agama">Agama</label>
                                        <input type="text" disabled required name="agama"
                                            value="{{ $penduduk->agama }}" class="form-control" id="agama"
                                            placeholder="Enter Tanggal lahir Anda">
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" disabled required name="alamat"
                                            value="{{ $penduduk->alamat }}" class="form-control" id="alamat"
                                            placeholder="Enter Alamat Anda">
                                    </div>
                                    <div class="form-group">
                                        <label for="pekerjaan">Pekerjaan</label>
                                        <input type="text" disabled required name="pekerjaan"
                                            value="{{ $penduduk->pekerjaan }}" class="form-control" id="pekerjaan"
                                            placeholder="Enter Pekerjaan">
                                    </div>
                                </div>

                                <div class="col">
                                    {{-- surat keterengan tidak mampu --}}
                                    <div id="form_keterangan_tidak_mampu" style="display: none">
                                        <div class="form-group">
                                            <label for="nama_orangtua">Nama Orang Tua</label>
                                            <input type="text" name="nama_orangtua" class="form-control"
                                                id="nama_orangtua" placeholder="Masukkan Nama Orang Tua">

                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label for="jekel_orangtua" class="form-label">Jenis Kelamin</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="jekel_orangtua"
                                                        id="jekel_laki" value="Laki-Laki" checked>
                                                    <label class="form-check-label" for="jekel_laki">
                                                        Laki-Laki
                                                    </label>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="jekel_orangtua"
                                                        id="jekel_perempuan" value="Perempuan">
                                                    <label class="form-check-label" for="jekel_perempuan">
                                                        Perempuan
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="umur_orangtua">Umur</label>
                                            <input type="number" name="umur_orangtua" class="form-control"
                                                id="umur_orangtua" placeholder="Masukkan Umur Orangtua">
                                        </div>
                                        <div class="form-group">
                                            <label for="pekerjaan_orangtua">Pekerjaan</label>
                                            <input type="text" name="pekerjaan_orangtua" class="form-control"
                                                id="pekerjaan_orangtua" placeholder="Masukkan Pekerjaan Orang Tua">
                                        </div>
                                        <div class="form-group">
                                            <label for="keterangan">Keperluan</label>
                                            <textarea name="keterangan" class="form-control" id="keterangan" placeholder="Masukkan Keperluan Surat"></textarea>
                                        </div>
                                    </div>

                                    {{-- Surat Keterangan kematian --}}
                                    <div class="form-group" id="form_keterangan_kematian" style="display: none">
                                        <label for="name_jenazah">Nama Jenazah *</label>
                                        <input type="text" name="name_jenazah" class="form-control" id="name_jenazah"
                                            placeholder="Enter Nama Jenazah">
                                    </div>
                                    <div class="form-group" id="tanggal_kematians" style="display: none">
                                        <label for="tanggal_kematian">Tanggal Kematian *</label>
                                        <input type="date" name="tanggal_kematian" class="form-control"
                                            id="tanggal_kematian" placeholder="Enter Tanggal Lahir Bayi">
                                    </div>
                                    <div class="form-group" id="waktu_kematians" style="display: none">
                                        <label for="waktu_kematian">Waktu Kematian *</label>
                                        <input type="time" name="waktu_kematian" class="form-control"
                                            id="waktu_kematian" placeholder="Enter Waktu Kematian">
                                    </div>
                                    <div class="form-group" id="sebab_kematians" style="display: none">
                                        <label for="sebab_kematian">Sebab Kematian *</label>
                                        <select name="sebab_kematian" class="form-control" id="sebab_kematian">
                                            <option value="">Pilih Sebab Kematian</option>
                                            <option value="sakis biasa / tua">Sakit Biasa / Tua</option>
                                            <option value="wabah penyakit">Wabah Penyakit</option>
                                            <option value="kecelakaan">Kecelakaan</option>
                                            <option value="kriminalitas">Kriminalitas</option>
                                            <option value="bunuh diri">Bunuh Diri</option>
                                            <option value="lainya">Lainya</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="tempat_kematians" style="display: none">
                                        <label for="tempat_kematian">Tempat Kematian *</label>
                                        <input type="text" name="tempat_kematian" class="form-control"
                                            id="tempat_kematian" placeholder="Enter Tempat Kematian">
                                    </div>
                                    <div class="form-group" id="saksi_keterangan_kematians" style="display: none">
                                        <label for="saksi_keterangan_kematian">Saksi Keterangan Kematian *</label>
                                        <select name="saksi_keterangan_kematian" class="form-control"
                                            id="saksi_keterangan_kematian">
                                            <option value="">Pilih Saksi Keterangan Kematian</option>
                                            <option value="dokter">Dokter</option>
                                            <option value="tenaga kesehatan">Tenaga Kesehatan</option>
                                            <option value="kepolisian">Kepolisian</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="#" type="button" class="btn btn-secondary">Kembali</a>
                            <button type="submit" name="submit" class="btn btn-primary float-right">Ajukan
                                Surat</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">

            </div>
        </div>
    </div><!-- /.container-fluid -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var jenisSuratSelect = document.getElementById('id_jenis_surat');
            var formKeteranganTidakMampu = document.getElementById('form_keterangan_tidak_mampu');
            var formKeteranganKematian = document.getElementById('form_keterangan_kematian');

            jenisSuratSelect.addEventListener('change', function() {
                // Sembunyikan semua formulir terlebih dahulu
                formKeteranganTidakMampu.style.display = 'none';
                formKeteranganKematian.style.display = 'none';

                // Ambil nilai ID jenis surat yang dipilih
                var selectedJenisSuratId = jenisSuratSelect.value;

                // Cetak nilai untuk pemeriksaan
                console.log('Selected Jenis Surat ID:', selectedJenisSuratId);

                // Tampilkan formulir yang sesuai dengan jenis surat yang dipilih
                if (selectedJenisSuratId === '1') {
                    formKeteranganTidakMampu.style.display = 'block';
                } else if (selectedJenisSuratId === '2') {
                    formKeteranganKematian.style.display = 'block';
                }
                // Tambahkan kondisi lain sesuai dengan jenis surat yang lain jika diperlukan
            });
        });
    </script>




@endsection
